@props(['disabled' => false, 'field' => '', 'value' => ''])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control mt-3']) !!}
    >{{-- passes in the user input to refill form after an error in other field --}}{{ $value }}</textarea>


    {{-- Displaying error messages --}}
@error($field)
    <div class="text-red"> {{ $message }}</div> 
@enderror