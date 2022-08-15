@props([
'id' => null,
'name',
'label' => '',
'value' => null,
])

@php
$id = $id ?? $name;
@endphp

<div>
    @if($label)
    <x-admin::label
        :for="$id"
        :value="$label"
        class="mb-1"
    />
    @endif

    <textarea
        {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full', 'rows' => 5]) !!} name="{{ $name }}" id="{{ $id }}">{{ old($name, $value) }}</textarea>
</div>