<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Imageable
{
    public function imageUrl(): string
    {
        return Storage::url($this->image);
    }

    public function deleteImage(): void
    {
        if ($this->image) {
            Storage::delete($this->image);
        }
    }
}
