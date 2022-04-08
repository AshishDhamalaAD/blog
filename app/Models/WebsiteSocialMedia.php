<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteSocialMedia extends Model
{
    use HasFactory;

    public function socialMedia(): BelongsTo
    {
        return $this->belongsTo(SocialMedia::class, 'social_media_id');
    }
}
