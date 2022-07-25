@props(['value'])

@php
    $class = $value ? 'bg-green-600 text-white' : 'bg-red-600 text-white';
@endphp

<x-admin::chip :class="$class">
    {{ $value ? 'Yes' : 'No' }}
</x-admin::chip>