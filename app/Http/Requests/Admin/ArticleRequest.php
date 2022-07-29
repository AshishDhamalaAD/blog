<?php

namespace App\Http\Requests\Admin;

use App\Models\Enums\UserTypeEnum;
use App\Models\Article;
use App\Models\Enums\ArticleStatusEnum;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $model = $this->route('article');

        return [
            'image' => ['bail', $model ? 'nullable' : 'required', 'image', 'max:1024'],
            'title' => ['bail', 'required', 'string', 'max:255'],
            'description' => ['bail', 'required', 'string', 'min:10'],
            'status' => ['bail', 'required', Rule::in(ArticleStatusEnum::values())],
            'published_at' => ['bail', 'nullable', 'date_format:Y-m-d H:i'],
            'tag_ids' => ['required', 'array'],
            'tag_ids.*' => ['integer', Rule::exists(Tag::class, 'id')],
        ];
    }

    public function createData(): array
    {
        $data = $this->safe()->except(['image', 'tag_ids']);
        $data['user_id'] = $this->user()->id;

        if ($this->image) {
            $data['image'] = $this->file('image')->store('images');
        }

        return $data;
    }

    public function updateData(Article $model): array
    {
        $data = $this->safe()->except(['image', 'tag_ids']);

        if ($this->image) {
            $model->deleteImage();

            $data['image'] = $this->file('image')->store('images');
        }

        return $data;
    }
}
