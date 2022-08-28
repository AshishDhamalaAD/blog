<x-frontend-layout>
    <div>
        <div class="mb-4">
            <h1 class="font-extrabold text-2xl">{{ $article->title }}</h1>
            <div class="text-sm text-gray-500">
                {{ $article->published_at->format('jS M, Y h:m a') }}
            </div>
        </div>

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

        <img
            src="{{ $article->imageUrl() }}"
            alt="article title"
            class="w-full"
        >

        <div class="mt-8">
            {!! $article->description !!}
        </div>

        {{-- advertisement --}}
        @if($bottomAd)
            <div class="mt-4">
                <img
                    src="{{ $bottomAd->imageUrl() }}"
                    alt="advertisement"
                    class="w-full"
                >
            </div>
        @endif

        {{-- tags --}}
        @if($article->tags->isNotEmpty())
            <div class="mt-4 flex items-center space-x-2">
                <strong>Tags:</strong>
                @foreach ($article->tags as $tag)
                    <a
                        href="{{ route('tags.articles', $tag) }}"
                        class="italic underline"
                    >
                        {{ $tag->name }}
                    </a>
                    @if(!$loop->last),@endif
                @endforeach
            </div>
        @endif

        {{-- share --}}
        <div class="mt-8 flex items-center space-x-2">
            <button class="flex items-center px-4 py-1 bg-[#3b5998] text-white">
                <x-icons.facebook class="w-3 h-3" />
                <span class="ml-2">Facebook</span>
            </button>
            <button class="flex items-center px-4 py-1 bg-[#00aced] text-white">
                <x-icons.twitter class="w-3 h-3" />
                <span class="ml-2">Twitter</span>
            </button>
        </div>

        <div class="border border-gray-100 mt-8"></div>

        {{-- user info --}}
        <div class="mt-8">
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-3">
                    <img
                        src="{{ $article->user->imageUrl() }}"
                        alt="{{ $article->user->name }}"
                        class="w-32 h-32 object-cover"
                    >
                </div>
                <div class="col-span-9">
                    <div class="font-bold text-lg">
                        {{ $article->user->name }}
                    </div>
                    <div class="mt-4 text-gray-500">
                        {!! $article->user->description !!}
                    </div>
                    <div class="mt-4 flex items-center space-x-2">
                        @foreach ($article->user->socialMedia as $media)
                            <a
                                href="{{ $media->pivot->url }}"
                                class="text-[{{ $media->color }}]"
                                target="_blank"
                            >
                                <x-dynamic-component :component="'icons.'.$media->nameLowercase()" class="w-4 h-4" />
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>