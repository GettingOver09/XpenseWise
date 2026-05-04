@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-primary text-start text-base font-medium text-ctext bg-primary/10 focus:outline-none focus:text-ctext focus:bg-primary/20 focus:border-primary transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-ctext hover:text-primary hover:bg-primary/10 hover:border-primary focus:outline-none focus:text-primary focus:bg-primary/10 focus:border-primary transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
