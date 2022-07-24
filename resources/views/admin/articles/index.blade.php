<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <x-admin::container>
        <x-admin::button :href="route('admin.'. $resources .'.create')">
            Add New
        </x-admin::button>

        <x-admin::card class="mt-4">
            <x-admin::table :headers="$headers">
                @foreach ($items as $item)
                    <x-admin::table.tr>
                        <x-admin::table.td>
                            <img
                                src="{{ $item->imageUrl() }}"
                                class="w-16 h-16 object-cover"
                            >
                        </x-admin::table.td>

                        <x-admin::table.td>
                            {{ $item->title }}
                        </x-admin::table.td>

                        <x-admin::table.td>
                            {{ $item->views }}
                        </x-admin::table.td>

                        <x-admin::table.td>
                            {{ $item->status->name }}
                        </x-admin::table.td>

                        <x-admin::table.td>
                            {{ $item->user->name }}
                        </x-admin::table.td>

                        <x-admin::table.td>
                            {{ $item->created_at->toDayDateTimeString() }}
                        </x-admin::table.td>

                        <x-admin::table.td>
                            {{ $item->published_at->toDayDateTimeString() }}
                        </x-admin::table.td>

                        <x-admin::table.td>
                            {{ $item->published_at->isPast() ? 'Yes' : 'No' }}
                        </x-admin::table.td>

                        <x-admin::table.td>
                            <x-admin::table.actions
                                :resource="$resource"
                                :model="$item"
                                :show-delete="$item->user_id !== auth()->id()"
                                :show-edit="$item->user_id !== auth()->id()"
                            />
                        </x-admin::table.td>
                    </x-admin::table.tr>
                @endforeach
            </x-admin::table>

            @if($items->hasPages())
                <div class="mt-4">
                    {{ $items->links() }}
                </div>
            @endif
        </x-admin::card>
    </x-admin::container>
</x-app-layout>