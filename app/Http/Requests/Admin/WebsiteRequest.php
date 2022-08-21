<?php

namespace App\Http\Requests\Admin;

use App\Models\Enums\UserTypeEnum;
use App\Models\Article;
use App\Models\Enums\ArticleStatusEnum;
use App\Models\Tag;
use App\Models\Website;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class WebsiteRequest extends FormRequest
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
        return [
            'logo' => ['bail', 'nullable', 'image', 'max:1024'],
            'favicon' => ['bail', 'nullable', 'image', 'max:200'],
            'name' => ['bail', 'required', 'string', 'max:255'],
            'phone' => ['bail', 'required', 'string', 'max:255'],
            'email' => ['bail', 'required', 'email', 'max:255'],
            'address' => ['bail', 'required', 'string', 'max:255'],
            'about' => ['bail', 'required', 'string', 'min:10'],
        ];
    }

    public function updateData(Website $model): array
    {
        $data = $this->safe()->except(['logo', 'favicon']);

        if ($this->logo) {
            $model->deleteImage('logo');

            $data['logo'] = $this->file('logo')->store('images');
        }

        if ($this->favicon) {
            $model->deleteImage('favicon');

            $data['favicon'] = $this->file('favicon')->store('images');
        }

        return $data;
    }
}
