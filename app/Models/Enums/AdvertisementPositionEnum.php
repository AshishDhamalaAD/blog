<?php

namespace App\Models\Enums;

use App\Models\Enums\Traits\EnumValues;

enum AdvertisementPositionEnum: int
{
    use EnumValues;

    case ARTICLE_TOP = 1;
    case ARTICLE_BOTTOM = 2;
    case ARTICLE_SIDE = 3;
    case HOME_TOP = 4;
    case HOME_SIDE = 5;
}
