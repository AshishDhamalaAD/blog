<?php

namespace App\Http\Requests\Admin;

use App\Models\Article;
use App\Models\Enums\MenuLayoutEnum;
use App\Models\Enums\UserTypeEnum;
use App\Models\Menu;
use App\Models\Enums\MenuStatusEnum;
use App\Models\Enums\MenuTypeEnum;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\RequiredIf;

class MenuRequest extends FormRequest
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
        $model = $this->route('menu');

        return [
            'name' => ['bail', 'required', 'string', 'max:255'],
            'parent_id' => ['bail', 'nullable', Rule::exists(Menu::class, 'id')->whereNull('parent_id')],
            'layout' => ['bail', 'required', new Enum(MenuLayoutEnum::class)],
            'type' => ['bail', 'required', new Enum(MenuTypeEnum::class)],
            'article_id' => ['bail', new RequiredIf($this->parent_id && $this->type == MenuTypeEnum::ARTICLE->value), Rule::exists(Article::class, 'id')],
            'url' => ['bail', new RequiredIf($this->type == MenuTypeEnum::BASIC->value), 'string'],
        ];
    }
}
