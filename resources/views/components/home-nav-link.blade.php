@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'font-bold text-teal-600'
                : 'font-bold';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
