<?php

namespace App\Models;

use App\Models\Enums\ArticlePublishedStatusEnum;
use App\Models\Enums\ArticleStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasFactory;
    use HasSlug;

    protected $casts = [
        'status' => ArticleStatusEnum::class,
        'published_at' => 'datetime',
    ];

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tags', 'article_id', 'tag_id')
            ->withTimestamps();
    }
}
