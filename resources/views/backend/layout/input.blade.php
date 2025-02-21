@props([
'type' => 'text', // Default input type
'name', // Field name (required)
'label' => null, // Optional label
'required' => false, // Required field?
'placeholder' => '', // Placeholder text
'validation' => '', // Validation rules (for JS)
'min' => null, // Min value
'max' => null, // Max value
])

<div class="mb-3">
    @if($label)
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif

    <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
        name="{{ $name }}" value="{{ old($name, $value ?? '') }}" placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }} {{ $min ? "min=$min" : '' }} {{ $max ? "max=$max" : '' }}
        data-validation="{{ $validation }}">

    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="invalid-feedback d-none">{{ $label ?? ucfirst($name) }} is required.</div>
</div>