<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <x-admin::container>
        <x-admin::button :href="route('admin.'. $routeResource .'.index', ['parent_id' => $parentMenu->id])">
            Go Back
        </x-admin::button>

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

                <input type="hidden" name="parent_id" value="{{ $parentMenu->id }}">

                <div class="grid grid-cols-2 gap-6">
                    @if($parentMenu->type->isBasic())
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
                    @endif

                    @if($parentMenu->type->isArticle())
                        <x-admin::select-group
                            :items="$articles"
                            id="article"
                            name="article_id"
                            label="Article"
                            required
                            x-model="articleId"
                        >
                            <x-slot name="bottom">
                                <div x-show="currentArticle" class="mt-2 text-sm">
                                    <span>Go to article:</span>
                                    <a x-bind:href="currentArticle.url" target="_blank" x-text="currentArticle.name" class="ml-1 text-theme"></a>
                                </div>
                            </x-slot>
                        </x-admin::select-group>

                        <x-admin::input-group
                            name="url"
                            :label="__('Url')"
                            x-bind:value="currentArticle?.url"
                            disabled
                        />
                    @endif

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
                articleId: "{{ old('article_id', $model->article_id) }}",
                articles: {{ Js::from($articles) }},
                get currentArticle() {
                    if (this.articleId === "") {
                        return null;
                    }

                    return this.articles.find(a => a.id == this.articleId);
                },
            }
        }
    </script>
    @endpush

</x-app-layout>