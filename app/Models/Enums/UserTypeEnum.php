<?php

namespace App\Models\Enums;

use App\Contracts\DorpdownableContract;
use App\Traits\EnumDropdownable;
use App\Traits\EnumValues;

enum UserTypeEnum: int implements DorpdownableContract
{
    use EnumValues;
    use EnumDropdownable;

    case ADMIN = 1;
    case NORMAL = 2;
    case EDITOR = 3;
}
