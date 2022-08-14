<?php

namespace App\Traits;

trait EnumValues
{
    public static function values(): array
    {
        return array_map(fn (self $enum) => $enum->value, self::cases());
    }

    public function prettyName(): string
    {
        return str($this->name)->replace('_', ' ')->title();
    }
}
