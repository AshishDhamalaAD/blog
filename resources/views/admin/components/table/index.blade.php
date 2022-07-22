@props([
'headers',
])

<div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="border-b">
                    <tr>
                        @foreach ($headers as $header)
                        <th
                            scope="col"
                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                        >
                            {{ $header }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>