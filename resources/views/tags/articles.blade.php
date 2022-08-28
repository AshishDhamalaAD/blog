<x-frontend-layout>
    <h1 class="text-2xl">
        Articles of tag <b class="capitalize">{{ $tag->name }}</b>
    </h1>
    <div class="mt-8">
        <x-article.grids :articles="$articles" />
    </div>
</x-frontend-layout>