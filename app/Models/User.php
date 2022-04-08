<?php

namespace App\Models;

use App\Models\Enums\UserTypeEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'type' => UserTypeEnum::class,
    ];

    public function socialMedia(): BelongsToMany
    {
        return $this->belongsToMany(SocialMedia::class, 'user_social_media', 'user_id', 'social_media_id')
            ->withPivot(['url'])
            ->withTimestamps();
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'user_id');
    }
}
