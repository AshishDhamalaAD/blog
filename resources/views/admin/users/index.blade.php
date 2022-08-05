<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <x-admin::container>
        <x-admin::button :href="route('admin.users.create')">
            Add New
        </x-admin::button>

        <x-admin::card class="mt-4">
            <x-admin::table :headers="$headers">
                @foreach ($items as $item)
                <x-admin::table.tr>
                    <x-admin::table.td>
                        @if($item->image)
                        <img
                            src="{{ $item->imageUrl() }}"
                            class="w-16 h-16 object-cover"
                        >
                        @else
                        <span>-</span>
                        @endif
                    </x-admin::table.td>

                    <x-admin::table.td>
                        {{ $item->name }}
                    </x-admin::table.td>

                    <x-admin::table.td>
                        {{ $item->email }}
                    </x-admin::table.td>

                    <x-admin::table.td>
                        {{ $item->type->name }}
                    </x-admin::table.td>

                    <x-admin::table.td>
                        {{ $item->created_at->toDayDateTimeString() }}
                    </x-admin::table.td>

                    <x-admin::table.td>
                        <x-admin::table.actions
                            :routeResource="$routeResource"
                            :resource="$resource"
                            :model="$item"
                            :show-edit="!$item->isAdmin() && $item->id !== auth()->id()"
                            :show-delete="!$item->isAdmin() && $item->id !== auth()->id()"
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