@props([
'disabled' => false,
'id' => null,
'name',
'label' => '',
'type' => 'text',
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

    <x-admin::input
        :id="$id"
        :type="$type"
        :name="$name"
        :value="old($name, $value)"
        :disabled="$disabled"
        {{$attributes}}
    />

    @error($name)
        <span class="text-red-500 mt-1">*{{ $message }}</span>
    @enderror
</div>