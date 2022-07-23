<?php

namespace App\Http\Requests\Admin;

use App\Models\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
        $user = $this->route('user');

        return [
            'image' => ['bail', 'nullable', 'image', 'max:1024'],
            'name' => ['bail', 'required', 'string', 'max:255'],
            'email' => ['bail', 'required', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id ?? null)],
            'password' => ['bail', $user ? 'nullable' : 'required', 'string', Password::defaults(), 'confirmed'],
            'description' => ['bail', 'required', 'string', 'min:10'],
            'type' => ['bail', 'required', Rule::in(UserTypeEnum::values())],
            'social_media_urls' => ['bail', 'nullable', 'array'],
            'social_media_urls.*' => ['bail', 'nullable',  'url', 'max:255'],
        ];
    }

    public function createData(): array
    {
        $data = $this->safe()->except(['social_media_urls']);

        $data['password'] = Hash::make($this->password);

        if ($this->image) {
            $data['image'] = $this->file('image')->store('images');
        }

        return $data;
    }

    public function socialMediaUrls(): Collection
    {
        return collect($this->get('social_media_urls', []))
            ->filter()
            ->map(fn ($url) => ['url' => $url]);
    }

    public function updateData(User $user): array
    {
        $data = $this->safe()->except(['social_media_urls']);

        $data['password'] = $this->password ? Hash::make($this->password) : $user->password;

        if ($this->image) {
            $user->deleteImage();

            $data['image'] = $this->file('image')->store('images');
        }

        return $data;
    }
}
