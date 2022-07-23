<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new User') }}
        </h2>
    </x-slot>

    <x-admin::container>
        <x-admin::card class="mt-4">
            <form
                action="{{ route('admin.users.store') }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <x-admin::input-group
                            name="image"
                            type="file"
                            :label="__('Image')"
                        />
                    </div>

                    <x-admin::input-group
                        name="name"
                        :label="__('Name')"
                        required
                    />

                    <x-admin::input-group
                        name="email"
                        type="email"
                        :label="__('Email')"
                        required
                    />

                    <x-admin::input-group
                        name="password"
                        type="password"
                        :label="__('Password')"
                        required
                    />

                    <x-admin::input-group
                        name="password_confirmation"
                        type="password"
                        :label="__('Confirm Password')"
                        required
                    />

                    <div class="col-span-2">
                        <x-admin::textarea-group
                            :label="__('Description')"
                            name="description"
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