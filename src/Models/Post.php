<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Molitor\Language\Models\Language;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'is_published',
        'lead',
        'layout',
        'main_image_url',
        'content_id',
        'language_id',
    ];

    protected $casts = [
        'content_id' => 'integer',
        'is_published' => 'boolean',
    ];

    protected $attributes = [
        'layout' => 'default',
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'post_authors', 'post_id', 'author_id');
    }

    public function postGroups(): BelongsToMany
    {
        return $this->belongsToMany(PostGroup::class, 'post_post_groups', 'post_id', 'post_group_id');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function postMeta(): HasMany
    {
        return $this->hasMany(PostMeta::class, 'post_id');
    }
}
