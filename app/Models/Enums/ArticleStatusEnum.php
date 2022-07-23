<?php

namespace App\Models\Enums;

use App\Models\Enums\Traits\EnumValues;

enum ArticleStatusEnum: int
{
    use EnumValues;

    case ACTIVE = 1;
    case IN_ACTIVE = 2;
}
