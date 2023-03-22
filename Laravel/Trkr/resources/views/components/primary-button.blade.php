<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary mt-3']) }}>
    {{ $slot }}
</button>