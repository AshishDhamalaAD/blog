<?php

namespace App\Models;

use App\Models\Enums\AdvertisementPositionEnum;
use App\Models\Enums\AdvertisementStatusEnum;
use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Advertisement extends Model
{
    use HasFactory;
    use Imageable;

    protected $casts = [
        'position' => AdvertisementPositionEnum::class,
        'status' => AdvertisementStatusEnum::class,
    ];

    public function imageUrl(): string
    {
        return Storage::url($this->image);
    }
}
