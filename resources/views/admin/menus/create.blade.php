<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <x-admin::container>
        <x-admin::card class="mt-4" x-data="{type: '{{ old('type', $model->type->value) }}', parent_id: '{{ old('parent_id', $model->parent_id) }}'}">
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
                        <x-admin::input-group
                            name="name"
                            :label="__('Name')"
                            :value="$model->name"
                            required
                        />
                    </div>

                    <x-admin::select-group
                        :items="$rootMenus"
                        id="root-menu"
                        name="parent_id"
                        label="Parent Menu"
                        :value="$model->parent_id"
                        x-model="parent_id"
                    />

                    <x-admin::select-group
                        :items="$layouts"
                        name="layout"
                        label="Layout"
                        :value="$model->layout->value"
                        required
                    />

                    <x-admin::select-group
                        :items="$types"
                        name="type"
                        label="Type"
                        {{-- :value="$model->type->value" --}}
                        x-model="type"
                        required
                    />


                    <template x-if="parent_id && type==='{{ \App\Models\Enums\MenuTypeEnum::ARTICLE->value }}'">
                        <x-admin::select-group
                            :items="$articles"
                            id="article"
                            name="article_id"
                            label="Article"
                            :value="$model->article_id"
                            required
                        />
                    </template>

                    <template x-if="type==='{{ \App\Models\Enums\MenuTypeEnum::BASIC->value }}'">
                        <x-admin::input-group
                            name="url"
                            :label="__('Url')"
                            :value="$model->url"
                            required
                        />
                    </template>

                    <div class="col-span-2">
                        <x-admin::button>Submit</x-admin::button>
                    </div>
                </div>

            </form>
        </x-admin::card>
    </x-admin::container>

</x-app-layout>