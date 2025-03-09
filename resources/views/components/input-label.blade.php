@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-ctext dark:text-ctext-dark']) }}>
    {{ $value ?? $slot }}
</label>
