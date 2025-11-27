@props([
    'name' => 'plus',
    'category' => 'actions',
    'variant' => 'outline',
    'size' => 'md',
    'class' => '',
    'alt' => '',
    'decorative' => false,
    'label' => '',
    'title' => ''
])

@php
    // Validate variant
    $validVariants = ['outline', 'solid'];
    $variant = in_array($variant, $validVariants) ? $variant : 'outline';
    
    // Support both 'category/name' format and separate category prop
    if (str_contains($name, '/')) {
        $path = $name;
    } else {
        $path = $category ? "{$category}/{$name}" : $name;
    }
    
    // Add variant to path
    $fullPath = "{$variant}/{$path}";
    
    // Size standardization
    $sizeMap = [
        'xs' => 14,
        'sm' => 18,
        'md' => 20,
        'lg' => 24,
        'xl' => 32,
        '2xl' => 40,
        '3xl' => 48,
    ];
    
    // If size is numeric, use it directly; otherwise, map from standardized sizes
    $pixelSize = is_numeric($size) ? $size : ($sizeMap[$size] ?? $sizeMap['md']);
    
    // Add size class for additional styling
    $sizeClass = is_numeric($size) ? '' : "icon-{$size}";
    
    // Determine accessible label
    $accessibleLabel = $label ?: ($alt ?: basename($name));
    
    // Determine if icon is purely decorative
    $isDecorative = $decorative || empty($accessibleLabel);
@endphp

@if($isDecorative)
    {{-- Decorative icon: hidden from screen readers --}}
    <img 
        src="{{ asset("svg/{$fullPath}.svg") }}" 
        width="{{ $pixelSize }}" 
        height="{{ $pixelSize }}" 
        alt=""
        aria-hidden="true"
        {{ $attributes->merge(['class' => trim("{$class} {$sizeClass}")]) }}
    />
@else
    {{-- Meaningful icon: accessible to screen readers --}}
    <img 
        src="{{ asset("svg/{$fullPath}.svg") }}" 
        width="{{ $pixelSize }}" 
        height="{{ $pixelSize }}" 
        alt="{{ $accessibleLabel }}"
        role="img"
        @if($title) title="{{ $title }}" @endif
        {{ $attributes->merge(['class' => trim("{$class} {$sizeClass}")]) }}
    />
@endif
