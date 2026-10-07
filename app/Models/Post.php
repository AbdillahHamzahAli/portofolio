<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Body must contain HTML sanitized by the writing boundary before persistence.
 * Cover paths are relative to the public disk; media paths are relative to their disk.
 */
#[Fillable(['title', 'slug', 'excerpt', 'body', 'cover_path', 'cover_alt', 'status', 'published_at'])]
class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    public const string MEDIA_DISK = 'public';

    /** @return array{status: class-string<PostStatus>, published_at: string} */
    protected function casts(): array
    {
        return [
            'status' => PostStatus::class,
            'published_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return HasMany<PostMedia, $this> */
    public function media(): HasMany
    {
        return $this->hasMany(PostMedia::class);
    }

    /** @param Builder<Post> $query */
    #[Scope]
    protected function published(Builder $query): void
    {
        $query->where('status', PostStatus::Published)
            ->where('published_at', '<=', now());
    }

    /** Directory for cover uploads belonging to a persisted post. */
    public function coversDirectory(): string
    {
        return "blog/{$this->getKey()}/covers";
    }

    /** Directory for inline image uploads belonging to a persisted post. */
    public function imagesDirectory(): string
    {
        return "blog/{$this->getKey()}/images";
    }
}
