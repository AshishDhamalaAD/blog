<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Imageable
{
    public function imageUrl(string $columnName = 'image'): string
    {
        return Storage::url($this->getRawOriginal($columnName));
    }

    public function deleteImage(string $columnName = 'image'): void
    {
        if ($image = $this->getRawOriginal($columnName)) {
            Storage::delete($image);
        }
    }
}
