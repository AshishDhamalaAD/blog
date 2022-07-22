@props([
'title' => ''
])

<div {{ $attributes->class(["block p-6 rounded-lg shadow-lg bg-white"]) }}>
    @if($title)
    <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">{{ $title }}</h5>
    @endif
    <div class="text-gray-700 text-base">
        {{ $slot }}
    </div>
</div>