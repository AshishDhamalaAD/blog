<?php

namespace App\Models\Enums;

use App\Contracts\DorpdownableContract;
use App\Traits\EnumDropdownable;
use App\Traits\EnumValues;

enum MenuLayoutEnum: int implements DorpdownableContract
{
    use EnumValues;
    use EnumDropdownable;

    case LIST = 1;
    case GRID = 2;
}
