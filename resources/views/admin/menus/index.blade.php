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
                            {{ $item->name }}
                            @if ($item->children_count > 0)
                                ({{ $item->children_count }})
                            @endif
                        </x-admin::table.td>

                        <x-admin::table.td>
                            {{ $item->type?->prettyName() ?? '-' }}
                        </x-admin::table.td>

                        <x-admin::table.td>
                            {{ $item->layout?->prettyName() ?? '-' }}
                        </x-admin::table.td>

                        <x-admin::table.td>
                            {{ $item->url ?? '-' }}
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
                            >
                                @if($item->layout !== null)
                                    <x-slot name="right">
                                        <a href="{{ route('admin.sub-menus.index', ['parent_id' => $item->id]) }}">
                                            <x-icons.eye class="w-5 h-5 text-green-500" />
                                        </a>
                                    </x-slot>
                                @endif
                            </x-admin::table.actions>
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