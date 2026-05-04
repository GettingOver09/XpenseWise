@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-ctext']) }}>
    {{ $value ?? $slot }}
</label>
