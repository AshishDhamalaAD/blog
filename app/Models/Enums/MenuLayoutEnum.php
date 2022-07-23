<?php

namespace App\Models\Enums;

use App\Models\Enums\Traits\EnumValues;

enum MenuLayoutEnum: int
{
    use EnumValues;

    case LIST = 1;
    case GRID = 2;
}
