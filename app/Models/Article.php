<?php

namespace App\Models;

use App\Contracts\DorpdownableContract;
use App\Models\Enums\ArticlePublishedStatusEnum;
use App\Models\Enums\ArticleStatusEnum;
use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Stevebauman\Purify\Facades\Purify;

class Article extends Model implements DorpdownableContract
{
    use HasFactory;
    use HasSlug;
    use Imageable;

    protected $casts = [
        'status' => ArticleStatusEnum::class,
        'published_at' => 'datetime',
    ];

    public function description(): Attribute
    {
        return new Attribute(function ($description) {
            return Purify::clean($description);
        });
    }

    public function publishedStatus(): Attribute
    {
        return new Attribute(function () {
            if ($this->isScheduled()) {
                return ArticlePublishedStatusEnum::from(ArticlePublishedStatusEnum::SCHEDULED->value);
            }

            if ($this->isPublished()) {
                return ArticlePublishedStatusEnum::from(ArticlePublishedStatusEnum::PUBLISHED->value);
            }

            if ($this->isDraft()) {
                return ArticlePublishedStatusEnum::from(ArticlePublishedStatusEnum::DRAFT->value);
            }
        });
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function isPublished(): bool
    {
        return $this->published_at?->isPast() === true;
    }

    public function isScheduled(): bool
    {
        return $this->published_at?->isFuture() === true;
    }

    public function isDraft(): bool
    {
        return $this->published_at?->isFuture() === null;
    }

    public function dropdownText(): string
    {
        return $this->title;
    }

    public function dropdownValue(): string|int
    {
        return $this->id;
    }

    public function imageUrl(): string
    {
        return Storage::url($this->image);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tags', 'article_id', 'tag_id')
            ->withTimestamps();
    }

    public function scopeVisible($query)
    {
        return $query->where('status', ArticleStatusEnum::ACTIVE)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at');
    }
}
