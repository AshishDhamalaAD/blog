@props([
'items',
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

    <select
        name="{{ $name }}"
        id="{{ $id }}"
        {{ $attributes->class(['rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full']) }}
    >
        <option value="">Select</option>
        @foreach ($items as $item)
            <option
                value="{{ $item->value }}"
                @if($item->value == old($name, $value)) selected @endif
            >
                {{ $item->name }}
            </option>
        @endforeach
    </select>

    @error($name)
        <span class="text-red-500 mt-1">*{{ $message }}</span>
    @enderror
</div>