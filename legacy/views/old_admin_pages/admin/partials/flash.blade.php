@php
    // Supported session keys: 'success', 'error', 'warning', 'info'
    $types = [
        'success' => ['class' => 'alert-success', 'icon' => 'fa-check-circle'],
        'error' => ['class' => 'alert-danger', 'icon' => 'fa-exclamation-circle'],
        'warning' => ['class' => 'alert-warning', 'icon' => 'fa-exclamation-triangle'],
        'info' => ['class' => 'alert-info', 'icon' => 'fa-info-circle'],
    ];

    /**
     * Resolve the session message value.
     * Accepts either a translation key string (e.g. 'alerts.2fa_regenerated')
     * or an array ['key' => 'alerts.reset_expires', 'params' => ['minutes' => 5]]
     * If the value is not a string, we fallback to casting to string.
     */
    if (! function_exists('resolveFlashMessage')) {
        function resolveFlashMessage($value) {
            if (is_array($value) && isset($value['key'])) {
                return __($value['key'], $value['params'] ?? []);
            }
            if (is_string($value)) {
                return __($value);
            }
            // fallback
            return (string) $value;
        }
    }
@endphp

@foreach($types as $key => $meta)
    @if(session()->has($key))
        @php $raw = session($key); $message = resolveFlashMessage($raw); @endphp
        <div class="alert {{ $meta['class'] }} alert-dismissible fade show" role="alert">
            <i class="fas {{ $meta['icon'] }} me-2" aria-hidden="true"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('app.close') }}"></button>
        </div>
    @endif
@endforeach
