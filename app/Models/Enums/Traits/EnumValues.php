<?php

namespace App\Models\Enums\Traits;

trait EnumValues
{
    public static function values(): array
    {
        return array_map(fn (self $enum) => $enum->value, self::cases());
    }
}
