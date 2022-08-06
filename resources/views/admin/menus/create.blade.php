<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <x-admin::container>
        <x-admin::card
            class="mt-4"
            x-data="data()"
        >
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
                    <x-admin::input-group
                        name="name"
                        :label="__('Name')"
                        :value="$model->name"
                        required
                    />

                    <x-admin::input-group
                        name="url"
                        :label="__('Url')"
                        :value="$model->url"
                        :placeholder="'Eg. ' . url('about')"
                    />

                    <div class="col-span-2">
                        <label
                            for="has-children"
                            class="inline-flex items-center"
                        >
                            <input
                                id="has-children"
                                type="checkbox"
                                class="rounded border-gray-300 text-theme shadow-sm focus:border-theme focus:ring focus:ring-theme focus:ring-opacity-50"
                                x-model="hasChildren"
                            >
                            <span class="ml-2 text-sm text-gray-600">{{ __('Has Children') }}</span>
                        </label>
                    </div>

                    <template x-if="hasChildren">
                        <x-admin::select-group
                            :items="$types"
                            name="type"
                            label="Children Type"
                            x-model="type"
                            x-on:change="handleChildrenTypeChange"
                        />
                    </template>

                    <template x-if="hasChildren">
                        <x-admin::select-group
                            :items="$layouts"
                            name="layout"
                            label="Children Layout"
                            x-model="layout"
                            x-bind:readonly="isTypeBasic"
                            x-bind:required="type!==''"
                        />
                    </template>

                    <template x-if="!hasChildren">
                        <div>
                            <input type="hidden" name="type" value="">
                            <input type="hidden" name="layout" value="">
                        </div>
                    </template>

                    {{-- @if(count($errors->all()))
                    @dd($errors->all(), old('layout'), old('type'))
                    @endif --}}

                    <div class="col-span-2">
                        <x-admin::button>Submit</x-admin::button>
                    </div>
                </div>

            </form>
        </x-admin::card>
    </x-admin::container>

    @push('script')
    <script>
        function data() {
            return {
                layout: "{{ old('layout', $model->layout?->value) }}",
                type: "{{ old('layout', $model->type?->value) }}",
                hasChildren: "{{ old('layout', $model->type?->value) }}" !== '',

                // get isList() {
                //     return this.layout === "{{ \App\Models\Enums\MenuLayoutEnum::LIST->value }}";
                // },

                // get isGrid() {
                //     return this.layout === "{{ \App\Models\Enums\MenuLayoutEnum::GRID->value }}";
                // },

                get isTypeBasic() {
                    return this.type === "{{ \App\Models\Enums\MenuTypeEnum::BASIC->value }}";
                },

                get isTypeArticle() {
                    return this.type === "{{ \App\Models\Enums\MenuTypeEnum::ARTICLE->value }}";
                },

                handleChildrenTypeChange() {
                    if (this.isTypeBasic) {
                        this.layout = "{{ \App\Models\Enums\MenuLayoutEnum::LIST->value }}";
                    } else {
                        this.layout = "";
                    }
                }
            }
        }
    </script>
    @endpush

</x-app-layout>