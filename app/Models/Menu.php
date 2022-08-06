<?php

namespace App\Models;

use App\Models\Enums\MenuLayoutEnum;
use App\Models\Enums\MenuTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => MenuTypeEnum::class,
        'layout' => MenuLayoutEnum::class,
    ];

    public function isRelatedToArticle(): bool
    {
        return $this->article_id !== null;
    }

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
