<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <x-admin::container>
        <x-admin::card class="mt-4">
            <form
                action="{{ route('admin.' . $routeResource . '.update') }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        @if($model->logo)
                        <div class="text-center">
                            <img
                                src="{{ $model->imageUrl('logo') }}"
                                class="w-48 h-32 mx-auto object-contain"
                            >
                            <span>Previous Logo</span>
                        </div>
                        @endif

                        <x-admin::input-group
                            name="logo"
                            type="file"
                            :label="__('Logo')"
                        />
                    </div>

                    <div>
                        @if($model->favicon)
                        <div class="text-center">
                            <img
                                src="{{ $model->imageUrl('favicon') }}"
                                class="w-48 h-32 mx-auto object-contain"
                            >
                            <span>Previous Favicon</span>
                        </div>
                        @endif

                        <x-admin::input-group
                            name="favicon"
                            type="file"
                            :label="__('Favicon')"
                        />
                    </div>

                    <x-admin::input-group
                        name="name"
                        :label="__('Name')"
                        :value="$model->name"
                        required
                    />

                    <x-admin::input-group
                        name="phone"
                        :label="__('Phone')"
                        :value="$model->phone"
                        required
                    />

                    <x-admin::input-group
                        name="email"
                        type="email"
                        :label="__('Email')"
                        :value="$model->email"
                        required
                    />

                    <x-admin::input-group
                        name="address"
                        :label="__('Address')"
                        :value="$model->address"
                        required
                    />

                    <div class="col-span-2">
                        <x-admin::textarea-group
                            :label="__('About')"
                            name="about"
                            id="about"
                            :value="$model->about"
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

    @push('script')
        <x-admin::tinymce-config id="about" />
    @endpush
</x-app-layout>