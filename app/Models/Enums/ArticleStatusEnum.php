<?php

namespace App\Models\Enums;

use App\Models\Enums\Traits\EnumValues;

enum ArticleStatusEnum: int
{
    use EnumValues;

    case ACTIVE = 1;
    case IN_ACTIVE = 2;

    public function bgClass(): string
    {
        return match ($this) {
            self::ACTIVE => 'bg-green-600 text-white',
            self::IN_ACTIVE => 'bg-red-600 text-white',
        };
    }
}
