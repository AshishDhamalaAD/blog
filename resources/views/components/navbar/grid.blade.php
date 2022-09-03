<a
    href="{{ $link }}"
    {{ $attributes->class(['block px-4 py-4 hover:text-theme transition-colors']) }}
>
    <div class="w-64">
        <img src="{{ $image }}"
            alt=""
            class="w-full h-40 object-cover">
        <div class="mt-1 text-center text-sm">{{ $title }}</div>
    </div>
</a>