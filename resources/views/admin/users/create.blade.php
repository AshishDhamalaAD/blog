<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new User') }}
        </h2>
    </x-slot>

    <x-admin::container>
        <x-admin::card class="mt-4">
            <form
                action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                @if($user->exists)
                    @method('PUT')
                @endif

                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-2">
                        @if($user->image)
                        <div class="text-center">
                            <img
                                src="{{ $user->imageUrl() }}"
                                class="w-32 h-32 mx-auto object-cover"
                            >
                            <span>Previous Image</span>
                        </div>
                        @endif

                        <x-admin::input-group
                            name="image"
                            type="file"
                            :label="__('Image')"
                        />
                    </div>

                    <x-admin::input-group
                        name="name"
                        :label="__('Name')"
                        :value="$user->name"
                        required
                    />

                    <x-admin::input-group
                        name="email"
                        type="email"
                        :label="__('Email')"
                        :value="$user->email"
                        required
                    />

                    <x-admin::input-group
                        name="password"
                        type="password"
                        :label="__('Password')"
                        :required="!$user->exists"
                    />

                    <x-admin::input-group
                        name="password_confirmation"
                        type="password"
                        :label="__('Confirm Password')"
                        :required="!$user->exists"
                    />

                    <x-admin::select-group
                        :items="$types"
                        name="type"
                        label="User Type"
                        :value="$user->type->value"
                    />

                    <div class="col-span-2">
                        <x-admin::textarea-group
                            :label="__('Description')"
                            name="description"
                            :value="$user->description"
                            required
                        />
                    </div>

                    <div class="col-span-2">
                        <x-admin::button>Submit</x-admin::button>
                    </div>
                </div>

            </form>
        </x-admin::card>
    </x-admin::container>
</x-app-layout>