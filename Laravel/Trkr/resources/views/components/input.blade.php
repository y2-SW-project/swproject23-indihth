@props(['disabled' => false, 'field' => ''])

{{-- wrapped in a div so they displayed blocks --}}
<div>
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' =>
            'form-control',
    ]) !!}>


    {{-- Displaying error messages --}}
    {{-- replace 'title' with the $field variable, can't hardcode --}}
    @error($field)
        <div class="text-red"> {{ $message }}</div>
    @enderror

</div>