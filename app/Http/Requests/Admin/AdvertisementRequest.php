<?php

namespace App\Http\Requests\Admin;

use App\Models\Advertisement;
use App\Models\Enums\AdvertisementPositionEnum;
use App\Models\Enums\AdvertisementStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdvertisementRequest extends FormRequest
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
        $model = $this->route('advertisement');

        return [
            'image' => ['bail', $model ? 'nullable' : 'required', 'image', 'max:1024'],
            'status' => ['bail', 'required', Rule::in(AdvertisementStatusEnum::values())],
            'position' => ['bail', 'required', Rule::in(AdvertisementPositionEnum::values())],
        ];
    }

    public function createData(): array
    {
        $data = $this->safe()->except(['image']);

        if ($this->image) {
            $data['image'] = $this->file('image')->store('images');
        }

        return $data;
    }

    public function updateData(Advertisement $model): array
    {
        $data = $this->safe()->except(['image']);

        if ($this->image) {
            $model->deleteImage();

            $data['image'] = $this->file('image')->store('images');
        }

        return $data;
    }
}
