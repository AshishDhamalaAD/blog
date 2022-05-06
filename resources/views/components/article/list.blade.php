<a
    {{ $attributes->class(['flex']) }}
    href="#"
>
    <img
        src="https://4.bp.blogspot.com/-TDoUeEz_iGI/Wf8eItNC3aI/AAAAAAAAA6U/CM2Ztmr-czQOjoeivWCL60hGNfiRtNSPgCLcBGAs/s1600/pexels-photo-532571.jpeg"
        alt="blog title"
        class="w-16 h-16 object-cover"
    >
    <div class="ml-2">
        <div class="text-theme text-sm">{{ $title }}</div>
        <div class="mt-1 text-gray-400">
            <span class="flex items-center">
                <x-icons.user class="w-3 h-3" />
                <span class="text-sm ml-2">Username</span>
            </span>
        </div>
    </div>
</a>