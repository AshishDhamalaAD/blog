<?php

namespace App\Traits;

trait EnumDropdownable
{
    public function dropdownText(): string
    {
        return $this->prettyName();
    }

    public function dropdownValue(): string|int
    {
        return $this->value;
    }
}
