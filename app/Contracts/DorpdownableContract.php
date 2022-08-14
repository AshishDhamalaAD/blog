<?php

namespace App\Contracts;

interface DorpdownableContract
{
    public function dropdownText(): string;

    public function dropdownValue(): string|int;
}
