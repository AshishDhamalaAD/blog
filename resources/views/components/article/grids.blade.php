@props([
    'articles'
])

<div class="grid grid-cols-2 gap-8">
    @foreach ($articles as $article)
        <x-article.grid
            :class="$loop->first ? 'col-span-2' : ''"
            :article="$article"
        />
    @endforeach
</div>

@if($articles->hasPages())
    <div class="flex items-center justify-center mt-8">
        <a href="{{ $articles->previousPageUrl() }}" class="w-32 bg-theme text-white text-center px-4 py-2 rounded shadow {{ !$articles->previousPageUrl() ? 'pointer-events-none bg-theme/70' : '' }}">Previous</a>
        <a href="{{ $articles->nextPageUrl() }}" class="w-32 bg-theme text-white text-center px-4 py-2 ml-2 rounded shadow {{ !$articles->nextPageUrl() ? 'pointer-events-none bg-theme/70' : '' }}">Next</a>
    </div>
@endif