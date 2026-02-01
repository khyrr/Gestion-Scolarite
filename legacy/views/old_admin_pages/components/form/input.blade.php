@props([
    'type' => 'text',
    'name' => '',
    'value' => '',
    'label' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'class' => ''
])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    
    <input 
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control {{ $class }} @error($name) is-invalid @enderror"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        {{ $attributes }}
    >
    
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
