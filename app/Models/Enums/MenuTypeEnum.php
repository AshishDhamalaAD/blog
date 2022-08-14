<?php

namespace App\Models\Enums;

use App\Traits\EnumValues;

enum MenuTypeEnum: int
{
    use EnumValues;

    case BASIC = 1;
    case ARTICLE = 2;

    public function isArticle(): bool
    {
        return $this === self::ARTICLE;
    }

    public function isBasic(): bool
    {
        return $this === self::BASIC;
    }
}
