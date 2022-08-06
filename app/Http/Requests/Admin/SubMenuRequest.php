<?php

namespace App\Http\Requests\Admin;

use App\Models\Article;
use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class SubMenuRequest extends FormRequest
{
    public Menu $parentMenu;

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
        $this->parentMenu = Menu::whereNull('parent_id')->findOrFail($this->parent_id);

        return [
            'parent_id' => ['bail', 'required', Rule::exists(Menu::class, 'id')->whereNull('parent_id')],
            'name' => ['bail', new RequiredIf($this->parentMenu->type->isBasic()), 'string', 'max:255'],
            'url' => ['bail', new RequiredIf($this->parentMenu->type->isBasic()), 'string', 'max:255'],
            'article_id' => ['bail', new RequiredIf($this->parentMenu->type->isArticle()), Rule::exists(Article::class, 'id')],
        ];
    }
}
