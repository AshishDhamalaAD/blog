<?php

namespace App\Models\Enums;

use App\Contracts\DorpdownableContract;
use App\Traits\EnumDropdownable;
use App\Traits\EnumValues;

enum MenuTypeEnum: int implements DorpdownableContract
{
    use EnumValues;
    use EnumDropdownable;

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
