<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Molitor\Language\Models\Language;

class Page extends Model
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
        return $this->belongsToMany(Author::class, 'page_authors', 'page_id', 'author_id');
    }

    public function pageGroups(): BelongsToMany
    {
        return $this->belongsToMany(PageGroup::class, 'page_page_groups', 'page_id', 'page_group_id');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function metaData(): HasMany
    {
        return $this->hasMany(PageMeta::class, 'page_id');
    }
}
