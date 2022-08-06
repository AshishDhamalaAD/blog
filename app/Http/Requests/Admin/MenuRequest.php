<?php

namespace App\Http\Requests\Admin;

use App\Models\Enums\MenuLayoutEnum;
use App\Models\Enums\MenuTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
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
            'url' => ['bail', 'nullable', 'string'],
            'type' => ['bail', 'nullable', new Enum(MenuTypeEnum::class)],
            'layout' => ['bail', 'nullable', new RequiredIf($this->type !== null), new Enum(MenuLayoutEnum::class)],
        ];
    }
}
