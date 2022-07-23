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
                @foreach ($users as $user)
                <x-admin::table.tr>
                    <x-admin::table.td>
                        @if($user->image)
                        <img
                            src="{{ $user->imageUrl() }}"
                            class="w-16 h-16 object-cover"
                        >
                        @else
                        <span>-</span>
                        @endif
                    </x-admin::table.td>

                    <x-admin::table.td>
                        {{ $user->name }}
                    </x-admin::table.td>

                    <x-admin::table.td>
                        {{ $user->email }}
                    </x-admin::table.td>

                    <x-admin::table.td>
                        {{ $user->created_at->toDayDateTimeString() }}
                    </x-admin::table.td>

                    <x-admin::table.td>
                        <div class="flex items-center space-x-2">
                            <a href="#">
                                <x-icons.edit class="w-5 h-5 text-blue-500" />
                            </a>
                            <button>
                                <x-icons.trash class="w-5 h-5 text-red-500" />
                            </button>
                        </div>
                    </x-admin::table.td>
                </x-admin::table.tr>
                @endforeach
            </x-admin::table>
        </x-admin::card>
    </x-admin::container>
</x-app-layout>