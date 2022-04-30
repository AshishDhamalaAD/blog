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
                        href="#"
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
            <div class="py-8 border-b">
                <div class="text-4xl text-center font-bold">CATALYST</div>
            </div>
            <div class="py-8">
                <div class="grid grid-cols-4 gap-8">
                    <div class="col-span-3">
                        <x-article.list-item title="The first article is here" />

                        <div class="grid grid-cols-2 gap-8 mt-8">
                            <x-article.list-item title="The first article is here" />
                            <x-article.list-item title="The first article is here" />
                            <x-article.list-item title="The first article is here" />
                            <x-article.list-item title="The first article is here" />
                            <x-article.list-item title="The first article is here" />
                            <x-article.list-item title="The first article is here" />
                        </div>
                    </div>
                    <div class="col-span-1 space-y-8">
                        <x-sidebar-card title="Advertisement">
                            content
                        </x-sidebar-card>
                        <x-sidebar-card title="Recent">
                            content 2
                        </x-sidebar-card>
                        <x-sidebar-card title="Popular">
                            content 3
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