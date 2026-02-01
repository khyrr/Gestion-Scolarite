@props([
    'name' => '',
    'value' => '',
    'label' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'rows' => 3,
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
    
    <textarea 
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        class="form-control {{ $class }} @error($name) is-invalid @enderror"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        {{ $attributes }}
    >{{ old($name, $value) }}</textarea>
    
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
