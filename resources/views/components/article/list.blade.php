@props([
    'article'
])


<a
    {{ $attributes->class(['flex']) }}
    href="#"
>
    <img
        src="{{ $article->imageUrl() }}"
        alt="blog title"
        class="w-16 h-16 object-cover"
    >
    <div class="ml-2">
        <div class="text-theme text-sm">{{ $article->title }}</div>
        <div class="mt-1 text-gray-400">
            <span class="flex items-center">
                <x-icons.user class="w-3 h-3" />
                <span class="text-sm ml-2">{{ $article->user->name }}</span>
            </span>
        </div>
    </div>
</a>