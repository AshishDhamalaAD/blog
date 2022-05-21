<a
    {{ $attributes->class(['relative w-full h-[400px] overflow-hidden block']) }}
    href="{{ route('articles.show', 'article-slug') }}"
>
    <img
        src="https://4.bp.blogspot.com/-TDoUeEz_iGI/Wf8eItNC3aI/AAAAAAAAA6U/CM2Ztmr-czQOjoeivWCL60hGNfiRtNSPgCLcBGAs/s1600/pexels-photo-532571.jpeg"
        alt="blog title"
        class="w-full h-full object-cover transition-transform hover:scale-110 duration-500"
    >
    <div class="absolute bottom-0 left-0 p-8 bg-black/30 w-full">
        <div class="text-gray-200 font-bold text-lg">{{ $title }}</div>
        <div class="mt-4">
            <span class="text-gray-200 flex items-center">
                <x-icons.user class="w-3 h-3" />
                <span class="text-sm ml-2">Username</span>
            </span>
        </div>
    </div>
</a>