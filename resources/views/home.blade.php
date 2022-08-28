<x-frontend-layout :sideAd="$sideAd">
    {{-- advertisement --}}
    @if($topAd)
        <div class="mb-4">
            <img
                src="{{ $topAd->imageUrl() }}"
                alt="advertisement"
                class="w-full"
            >
        </div>
    @endif

    <x-article.grids :articles="$articles" />
</x-frontend-layout>