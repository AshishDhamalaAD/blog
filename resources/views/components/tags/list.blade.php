@props([
    'tag'
])

<a
    class="py-2 flex items-center text-gray-600 border-b border-gray-200"
    href="{{ route('tags.articles', $tag) }}"
>
    <x-icons.chevron-right class="w-3 h-3" />
    <div class="ml-2">{{ $tag->name }}</div>
</a>