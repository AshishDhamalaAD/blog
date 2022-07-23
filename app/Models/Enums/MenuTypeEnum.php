<?php

namespace App\Models\Enums;

use App\Models\Enums\Traits\EnumValues;

enum MenuTypeEnum: int
{
    use EnumValues;

    case BASIC = 1;
    case ARTICLE = 2;
}
