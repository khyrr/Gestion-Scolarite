@props([
    'name' => '',
    'label' => '',
    'options' => [],
    'selected' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false
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
    
    <select 
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-select @error($name) is-invalid @enderror"
        @if($required) required @endif
        @if($disabled) disabled @endif
        {{ $attributes }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        
        @foreach($options as $value => $text)
            <option value="{{ $value }}" 
                @if(old($name, $selected) == $value) selected @endif
            >
                {{ $text }}
            </option>
        @endforeach
    </select>
    
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
