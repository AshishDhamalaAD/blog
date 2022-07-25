@props(['nowrap' => false])

<td {{ $attributes->class(['text-sm text-gray-900 font-light px-4 py-2', 'whitespace-nowrap' => $nowrap]) }}>
    {{ $slot }}
</td>