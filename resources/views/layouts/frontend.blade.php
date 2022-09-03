<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Laravel</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/js/app.js'])

</head>

<body class="antialiased bg-theme px-2 lg:px-8">
    <header>
        <x-container>
            <div class="flex items-center justify-between py-2">
                <div class="flex items-center space-x-4">
                    <a
                        href="{{ route('home') }}"
                        class="text-white block"
                    >Home</a>
                    <a
                        href="{{ route('about-us') }}"
                        class="text-white block"
                    >About</a>
                    <a
                        href="{{ route('contact-us') }}"
                        class="text-white block"
                    >Contact</a>
                </div>
                <div class="flex items-center space-x-4">
                    @foreach ($websiteSocialMedia as $websiteMedia)
                        <a
                            href="{{ $websiteMedia->url }}"
                            class="text-white block"
                        >
                            <x-dynamic-component :component="'icons.'.$websiteMedia->socialMedia->nameLowercase()" class="w-4 h-4" />
                        </a>
                    @endforeach
                </div>
            </div>
        </x-container>
    </header>

    <main>
        <x-container class="bg-white">
            <div class="py-8">
                <div class="text-4xl text-center font-bold">CATALYST</div>
            </div>
            <nav class="border-b border-t">
                <ul class="flex items-center justify-center relative">
                    @foreach ($menus as $menu)
                        @if($menu->hasNoChildren())
                            <li>
                                <x-navbar.list :title="$menu->name" :link="$menu->url" />
                            </li>
                        @else
                            @if($menu->type->isBasic())
                                <li class="relative group">
                                    <div class="flex items-center">
                                        <x-navbar.list :title="$menu->name" link="#" />
                                        <x-icons.chevron-down class="w-2 h-2" />
                                    </div>
                                    <div class="absolute top-[57px] left-0 z-10 min-w-[300px] bg-white shadow invisible opacity-0 translate-y-10 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all">
                                        @foreach ($menu->children as $child)
                                            <x-navbar.list :title="$child->name" :link="$child->url" class="border-b" />
                                        @endforeach
                                    </div>
                                </li>
                            @elseif($menu->type->isArticle())
                                <li class="group">
                                    <div class="flex items-center">
                                        <x-navbar.list :title="$menu->name" link="#" />
                                        <x-icons.chevron-down class="w-2 h-2" />
                                    </div>
                                    <div class="absolute top-[57px] left-0 z-10 min-w-full bg-white shadow invisible opacity-0 translate-y-10 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all">
                                        <div class="flex justify-center">
                                            @foreach ($menu->children as $child)
                                                <x-navbar.grid :title="$child->article->title" :link="route('articles.show', $child->article)" :image="$child->article->imageUrl()" />
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </nav>
            <div class="py-8">
                <div class="grid grid-cols-4 gap-8">
                    <div class="col-span-3">
                        {{ $slot }}
                    </div>
                    <div class="col-span-1 space-y-8">
                        @if($sideAd?->exists)
                            <x-sidebar-card title="Advertisement">
                                <img
                                    src="{{ $sideAd->imageUrl() }}"
                                    alt="advertisement"
                                    class="w-full"
                                >
                            </x-sidebar-card>
                        @endif
                        <x-sidebar-card title="Recent">
                            <div class="space-y-2">
                                @foreach ($recentArticles as $recentArticle)
                                    <x-article.list :article="$recentArticle" />
                                @endforeach
                            </div>
                        </x-sidebar-card>
                        <x-sidebar-card title="Popular">
                            <div class="space-y-2">
                                @foreach ($popularArticles as $popularArticle)
                                    <x-article.list :article="$popularArticle" />
                                @endforeach
                            </div>
                        </x-sidebar-card>
                        <x-sidebar-card title="Popular Tags">
                            <div class="space-y-2">
                                @foreach ($tags as $tag)
                                    <x-tags.list :tag="$tag" />
                                @endforeach
                            </div>
                        </x-sidebar-card>
                    </div>
                </div>
            </div>
        </x-container>
    </main>

    <footer>
        <x-container>
            <div class="py-4 text-white">
                ©Catalyst, {{ date('Y') }}. All rights reserved.
            </div>
        </x-container>
    </footer>
</body>

</html>