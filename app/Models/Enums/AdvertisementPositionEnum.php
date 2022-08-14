<?php

namespace App\Models\Enums;

use App\Contracts\DorpdownableContract;
use App\Traits\EnumDropdownable;
use App\Traits\EnumValues;

enum AdvertisementPositionEnum: int implements DorpdownableContract
{
    use EnumValues;
    use EnumDropdownable;

    case ARTICLE_TOP = 1;
    case ARTICLE_BOTTOM = 2;
    case ARTICLE_SIDE = 3;
    case HOME_TOP = 4;
    case HOME_SIDE = 5;
}
