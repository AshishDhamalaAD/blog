<?php

namespace App\Models\Enums;

use App\Traits\EnumValues;

enum UserTypeEnum: int
{
    use EnumValues;

    case ADMIN = 1;
    case NORMAL = 2;
    case EDITOR = 3;
}
