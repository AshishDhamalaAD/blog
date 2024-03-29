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

    <link
        rel="stylesheet"
        href="{{ mix('css/app.css') }}"
    >

</head>

<body class="antialiased bg-theme px-2 lg:px-8">
    <header>
        <x-container>
            <div class="flex items-center justify-between py-2">
                <div class="flex items-center space-x-4">
                    <a
                        href="/"
                        class="text-white block"
                    >Home</a>
                    <a
                        href="#"
                        class="text-white block"
                    >About</a>
                    <a
                        href="#"
                        class="text-white block"
                    >Contact</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a
                        href="#"
                        class="text-white block"
                    >
                        <x-icons.instagram class="w-4 h-4" />
                    </a>
                    <a
                        href="#"
                        class="text-white block"
                    >
                        <x-icons.facebook class="w-4 h-4" />
                    </a>
                    <a
                        href="#"
                        class="text-white block"
                    >
                        <x-icons.twitter class="w-4 h-4" />
                    </a>
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
                    <li>
                        <x-navbar.list title="Home" link="/" />
                    </li>
                    <li>
                        <x-navbar.list title="Documentation" link="#" />
                    </li>
                    <li class="relative group">
                        <div class="flex items-center">
                            <x-navbar.list title="Sub Menu" link="#" />
                            <x-icons.chevron-down class="w-2 h-2" />
                        </div>
                        <div class="absolute top-[57px] left-0 z-10 min-w-[300px] bg-white shadow invisible opacity-0 translate-y-10 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all">
                            <x-navbar.list title="Sub Sub Menu skdfj slkdjf lksdjf l" link="#" class="border-b" />
                            <x-navbar.list title="Sub Sub Menu" link="#" class="border-b" />
                            <x-navbar.list title="Sub Sub Menu" link="#" class="border-b" />
                            <x-navbar.list title="Sub Sub Menu" link="#" class="border-b" />
                        </div>
                    </li>
                    <li class="group">
                        <div class="flex items-center">
                            <x-navbar.list title="Sub Menu With Image" link="#" />
                            <x-icons.chevron-down class="w-2 h-2" />
                        </div>
                        <div class="absolute top-[57px] left-0 z-10 min-w-full bg-white shadow invisible opacity-0 translate-y-10 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all">
                            <div class="flex justify-center">
                                <x-navbar.grid title="Sub Sub Menu skdfj slkdjf lksdjf l" link="#" />
                                <x-navbar.grid title="Sub Sub Menu" link="#" />
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="py-8">
                <div class="grid grid-cols-4 gap-8">
                    <div class="col-span-3">
                        {{ $slot }}
                    </div>
                    <div class="col-span-1 space-y-8">
                        <x-sidebar-card title="Advertisement">
                            content
                        </x-sidebar-card>
                        <x-sidebar-card title="Recent">
                            <div class="space-y-2">
                                <x-article.list title="The first article is here slfj slkdfj lskfjlskdjf lskdjf l" />
                                <x-article.list title="The first article is here" />
                                <x-article.list title="The first article is here" />
                                <x-article.list title="The first article is here" />
                                <x-article.list title="The first article is here" />
                            </div>
                        </x-sidebar-card>
                        <x-sidebar-card title="Popular">
                            <div class="space-y-2">
                                <x-article.list title="The first article is here" />
                                <x-article.list title="The first article is here the first article is here" />
                                <x-article.list title="The first article is here" />
                                <x-article.list title="The first article is here" />
                                <x-article.list title="The first article is here" />
                            </div>
                        </x-sidebar-card>
                        <x-sidebar-card title="Tags">
                            <div class="space-y-2">
                                <x-tags.list />
                                <x-tags.list />
                                <x-tags.list />
                                <x-tags.list />
                                <x-tags.list />
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

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>