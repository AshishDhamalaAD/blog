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
                        {{ $user->type->name }}
                    </x-admin::table.td>

                    <x-admin::table.td>
                        {{ $user->created_at->toDayDateTimeString() }}
                    </x-admin::table.td>

                    <x-admin::table.td>
                        <x-admin::table.actions
                            resource="user"
                            :model="$user"
                            :show-delete="$user->id !== auth()->id()"
                        />
                    </x-admin::table.td>
                </x-admin::table.tr>
                @endforeach
            </x-admin::table>

            @if($users->hasPages())
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            @endif
        </x-admin::card>
    </x-admin::container>
</x-app-layout>