@props([
    'resource',
    'model',
    'showEdit' => true,
    'showDelete' => true,
])

@php
    $resources = Str::plural($resource);
@endphp

<div class="flex items-center space-x-2">
    {{ $left ?? null }}

    @if($showEdit)
        <a href="{{ route("admin.{$resources}.edit", $model) }}">
            <x-icons.edit class="w-5 h-5 text-blue-500" />
        </a>
    @endif

    @if($showDelete)
        <form
            action="{{ route("admin.{$resources}.destroy", $model) }}"
            method="post"
            class="flex"
            x-data="{ resource: '{{ $resource }}' }"
            x-ref="deleteForm"
            x-on:submit.prevent="() => confirm(`Are you sure, you want to delete this ${resource}?`) ? $refs.deleteForm.submit() : null"
        >
            @csrf
            @method('DELETE')
            <button>
                <x-icons.trash class="w-5 h-5 text-red-500" />
            </button>
        </form>
    @endif

    {{ $right ?? null }}
</div>