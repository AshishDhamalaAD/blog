<x-frontend-layout>
    <div>
        {{-- advertisement --}}
        <div class="mb-4">
            <img
                src="https://2.bp.blogspot.com/-vkooCNOHzKw/WqbQQk7MDtI/AAAAAAAABI4/bRC-UVtU5A0YAWewTLql3H2zUGBhc8uewCLcBGAs/s1600/728-1.jpg"
                alt="advertisement"
                class="w-full"
            >
        </div>

        <img
            src="https://4.bp.blogspot.com/-TDoUeEz_iGI/Wf8eItNC3aI/AAAAAAAAA6U/CM2Ztmr-czQOjoeivWCL60hGNfiRtNSPgCLcBGAs/s1600/pexels-photo-532571.jpeg"
            alt="article title"
            class="w-full"
        >

        <div class="mt-8">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>

            <p class="mt-4">dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing
                elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        {{-- advertisement --}}
        <div class="my-4">
            <img
                src="https://2.bp.blogspot.com/-vkooCNOHzKw/WqbQQk7MDtI/AAAAAAAABI4/bRC-UVtU5A0YAWewTLql3H2zUGBhc8uewCLcBGAs/s1600/728-1.jpg"
                alt="advertisement"
                class="w-full"
            >
        </div>

        {{-- tags --}}
        <div class="flex items-center space-x-2">
            <span>Tags:</span>
            <a
                href="#"
                class="italic underline"
            >tag 1,</a>
            <a
                href="#"
                class="italic underline"
            >tag 2,</a>
            <a
                href="#"
                class="italic underline"
            >tag 3,</a>
        </div>

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
                        src="https://2.bp.blogspot.com/-bevgFjjCS-A/Wf8QFKETXvI/AAAAAAAAA44/5M6_nw-QnOMDrVTocETug06M4WXAbtjvQCLcBGAs/s1600/pexels-photo-220570-min.jpeg"
                        alt="user name"
                        class="w-32 h-32 object-cover"
                    >
                </div>
                <div class="col-span-9">
                    <div class="font-bold text-lg">
                        Ashish Dhamala
                    </div>
                    <div class="mt-4 text-gray-500">
                        Hey there, We are Blossom Themes! We are trying to provide you the new way to look and use the
                        blogger templates. Our designers are working hard and pushing the boundaries of possibilities to
                        widen the horizon of the regular templates and provide high quality blogger templates to all
                        hardworking bloggers!
                    </div>
                    <div class="mt-4 flex items-center space-x-2">
                        <a
                            href="#"
                            class="text-[#3b5999]"
                        >
                            <x-icons.facebook class="w-4 h-4" />
                        </a>
                        <a
                            href="#"
                            class="text-[#55acee]"
                        >
                            <x-icons.twitter class="w-4 h-4" />
                        </a>
                        <a
                            href="#"
                            class="text-[#e4405f]"
                        >
                            <x-icons.instagram class="w-4 h-4" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>