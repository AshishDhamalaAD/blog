<?php

namespace App\Models\Enums;

use App\Traits\EnumValues;

enum ArticlePublishedStatusEnum: int
{
    use EnumValues;

    case PUBLISHED = 1;
    case SCHEDULED = 2;
    case DRAFT = 3;

    public function chipClass(): string
    {
        return match ($this) {
            self::PUBLISHED => 'bg-green-600 text-white',
            self::SCHEDULED => 'bg-blue-600 text-white',
            self::DRAFT => 'bg-yellow-400',
        };
    }
}
