{{-- resources/views/admin/auth/2fa/partials/pending-alert.blade.php --}}
@if(!empty($regenerated) || !empty($pending_cookie) || session()->has('admin_2fa_pending_regeneration'))
    @php
        $expiryTs = null;
        if (!empty($pending_cookie['expires_at'])) {
            $expiryTs = $pending_cookie['expires_at'];
        } elseif (session('admin_2fa_pending_regeneration.created_at')) {
            $ttl = session('admin_2fa_pending_regeneration.ttl_seconds') ?? 600;
            $expiryTs = session('admin_2fa_pending_regeneration.created_at') + $ttl;
        }
        $expiresAtHuman = $expiryTs ? \Carbon\Carbon::createFromTimestamp($expiryTs)->diffForHumans() : null;
    @endphp

    <div id="twofa-pending-banner" data-expiry="{{ $expiryTs ?? '' }}" class="tf-banner" role="status" aria-live="polite"
        aria-atomic="true">
        <div class="tf-banner-text">
            <strong>{{ __('app.rappel') }} — {{ __('app.regeneration_2fa_en_attente') }}</strong>
            <span>{{ __('app.nouveau_secret_genere') }}. {{ __('app.ancien_secret_reste_actif') }}.</span>
            <span id="twofa-countdown" style="opacity: 0.8; font-size: 13px; margin-left: 8px;">
                {{ $expiresAtHuman ?? 'expirant bientôt' }}
            </span>
        </div>

        <a href="{{ route('admin.2fa.setup') }}" class="tf-banner-btn">
            {{ __('app.finaliser') }}
        </a>
    </div>

    <script>
        (function () {
            const banner = document.getElementById('twofa-pending-banner');
            if (!banner) return;

            const expiry = Number(banner.getAttribute('data-expiry')) || null;
            const countdownEl = document.getElementById('twofa-countdown');

            // format helper
            function formatTimeLeft(sec) {
                sec = Math.max(0, Math.floor(sec));
                const h = Math.floor(sec / 3600);
                const m = Math.floor((sec % 3600) / 60);
                const s = sec % 60;
                if (h > 0) return `${h}h ${m}m ${s}s`;
                if (m > 0) return `${m}m ${s}s`;
                return `${s}s`;
            }

            // schedule next tick aligned to the next full second to save CPU
            function scheduleTick(next) {
                const nowMs = Date.now();
                const delay = Math.max(0, Math.ceil(next - nowMs));
                return setTimeout(tick, delay);
            }

            let timeoutId = null;

            function tick() {
                if (!expiry) return;

                const now = Math.floor(Date.now() / 1000);
                const left = expiry - now;

                if (left <= 0) {
                    // hide banner
                    banner.style.display = 'none';

                    // try to notify server to clear pending (use sendBeacon if possible)
                    const url = "{{ route('admin.2fa.clear_pending') }}";
                    const payload = JSON.stringify({ reason: 'expired' });
                    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

                    if (navigator.sendBeacon) {
                        const blob = new Blob([payload], { type: 'application/json' });
                        navigator.sendBeacon(url, blob);
                    } else {
                        // best-effort fetch with keepalive
                        fetch(url, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
                            body: payload,
                            keepalive: true
                        }).catch(() => { });
                    }
                    return;
                }

                // update UI
                if (countdownEl) {
                    countdownEl.textContent = formatTimeLeft(left);
                }

                // compute ms until next whole second + small margin
                const nextMs = (Math.floor(Date.now() / 1000) + 1) * 1000 + 20;
                timeoutId = scheduleTick(nextMs);
            }

            // start: if expiry exists, update immediately and schedule
            if (expiry) {
                tick();
            }

            // cleanup on page unload
            window.addEventListener('beforeunload', function () {
                if (timeoutId) clearTimeout(timeoutId);
            });
        })();
    </script>
@endif