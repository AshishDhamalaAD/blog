<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <x-admin::container>
        <x-admin::card class="mt-4">
            <form
                action="{{ $model->exists ? route('admin.' . $routeResource . '.update', $model) : route('admin.' . $routeResource . '.store') }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                @if($model->exists)
                    @method('PUT')
                @endif

                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-2">
                        @if($model->image)
                        <div class="text-center">
                            <img
                                src="{{ $model->imageUrl() }}"
                                class="w-48 h-32 mx-auto object-contain"
                            >
                            <span>Previous Thumbnail</span>
                        </div>
                        @endif

                        <x-admin::input-group
                            name="image"
                            type="file"
                            :label="__('Image')"
                            :required="!$model->exists"
                        />
                    </div>

                    <x-admin::select-group
                        :items="$positions"
                        name="position"
                        label="Position"
                        :value="$model->position?->value"
                        required
                    />

                    <x-admin::select-group
                        :items="$statuses"
                        name="status"
                        label="Status"
                        :value="$model->status->value"
                        required
                    />

                    <div class="col-span-2">
                        <x-admin::button>Submit</x-admin::button>
                    </div>
                </div>

            </form>
        </x-admin::card>
    </x-admin::container>

</x-app-layout>