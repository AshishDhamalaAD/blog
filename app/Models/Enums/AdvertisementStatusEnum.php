<?php

namespace App\Models\Enums;

use App\Contracts\DorpdownableContract;
use App\Traits\EnumDropdownable;
use App\Traits\EnumValues;

enum AdvertisementStatusEnum: int implements DorpdownableContract
{
    use EnumValues;
    use EnumDropdownable;

    case ACTIVE = 1;
    case IN_ACTIVE = 2;

    public function chipClass(): string
    {
        return match ($this) {
            self::ACTIVE => 'bg-green-600 text-white',
            self::IN_ACTIVE => 'bg-red-600 text-white',
        };
    }
}
