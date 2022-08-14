<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <x-admin::container>
        <x-admin::button :href="route('admin.'. $routeResource .'.create')">
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

                        <x-admin::table.td nowrap>
                            <x-admin::chip>
                                {{ $item->position->prettyName() }}
                            </x-admin::chip>
                        </x-admin::table.td>

                        <x-admin::table.td nowrap>
                            <x-admin::chip :class="$item->status->chipClass()">
                                {{ $item->status->prettyName() }}
                            </x-admin::chip>
                        </x-admin::table.td>

                        <x-admin::table.td>
                            {{ $item->created_at->toDayDateTimeString() }}
                        </x-admin::table.td>

                        <x-admin::table.td>
                            <x-admin::table.actions
                                :routeResource="$routeResource"
                                :resource="$resource"
                                :model="$item"
                                :show-delete="auth()->user()->can('delete', $item)"
                                :show-edit="auth()->user()->can('update', $item)"
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