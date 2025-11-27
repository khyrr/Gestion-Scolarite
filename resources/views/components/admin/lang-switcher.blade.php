<div class="lang-switcher dropdown d-none d-lg-block">
    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-label="{{ __('app.change_language') }}">
        @php $current = app()->getLocale(); @endphp
        @php $currentFlag = $locales[$current]['flag'] ?? $current; @endphp
        <span class="fi fi-{{ $currentFlag }}"></span>
        <span class="{{ $current === 'ar' ? 'me-1' : 'ms-1' }}">{{ strtoupper($current) }}</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        @foreach($locales as $code => $meta)
            @php
                $flag = $meta['flag'] ?? $code;
                $label = $meta['label'] ?? strtoupper($code);
            @endphp
            <li>
                <a class="dropdown-item {{ app()->getLocale() === $code ? 'active' : '' }}" href="{{ \Illuminate\Support\Facades\Route::has('admin.lang.switch') ? route('admin.lang.switch', $code) : url('/langue/'.$code) }}">
                    <span class="fi fi-{{ $flag }} {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></span>
                    {{ $label }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
