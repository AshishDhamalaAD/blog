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
                            :label="__('Thumbnail')"
                        />
                    </div>

                    <div class="col-span-2">
                        <x-admin::input-group
                            name="title"
                            :label="__('Title')"
                            :value="$model->title"
                            required
                        />
                    </div>

                    <div class="col-span-2">
                        <x-admin::textarea-group
                            :label="__('Description')"
                            name="description"
                            id="description"
                            :value="$model->description"
                            required
                        />
                    </div>

                    <div class="col-span-2">
                        <x-admin::select-group
                            :items="$tags"
                            id="tag-ids"
                            name="tag_ids[]"
                            label="Tags"
                            :value="$model->tag_ids"
                            multiple
                            hide-select
                        />
                    </div>

                    <x-admin::select-group
                        :items="$statuses"
                        name="status"
                        label="Status"
                        :value="$model->status->value"
                    />

                    <div>
                        <x-admin::label
                            :value="__('Published At')"
                            class="mb-1"
                        />

                        <x-flatpickr
                            name="published_at"
                            :min-date="$model->published_at ?? today()"
                            show-time
                            :value="old('published_at', $model->published_at)"
                            :disabled="$model->isPublished()"
                        />

                        @error('published_at')
                            <span class="text-red-500 mt-1">*{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <x-admin::button>Submit</x-admin::button>
                    </div>
                </div>

            </form>
        </x-admin::card>
    </x-admin::container>

    @push('style')
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.css"> 
    @endpush

    @push('script')
        <x-admin::tinymce-config id="description" category="article" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.js"></script>

        <script>
            new SlimSelect({
                select: '#tag-ids'
            });
        </script>
    @endpush
</x-app-layout>