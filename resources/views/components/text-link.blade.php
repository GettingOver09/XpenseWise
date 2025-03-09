@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary text-sm font-medium leading-5 text-ctext dark:text-ctext-dark focus:outline-none focus:border-primary-dark transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-ctext dark:text-ctext-dark hover:text-primary dark:hover:text-primary-dark hover:border-primary focus:outline-none focus:text-primary focus:border-primary transition duration-150 ease-in-out';
@endphp

<div
    class="mt-5 p-5 bg-background dark:bg-background-dark shadow-lg dark:shadow-primary-dark overflow-hidden sm:rounded-lg">

    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</div>
