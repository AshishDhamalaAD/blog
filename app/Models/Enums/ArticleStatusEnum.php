<?php

namespace App\Models\Enums;

enum ArticleStatusEnum: int
{
    case ACTIVE = 1;
    case IN_ACTIVE = 2;
    case PUBLISHED = 3;
}
