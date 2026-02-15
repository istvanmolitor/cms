<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'layout',
        'main_image_url',
        'content_id',
        'draft_content_id',
        'language_id',
    ];

    protected $casts = [
        'content_id' => 'integer',
    ];

    protected $attributes = [
        'layout' => 'default',
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }

    public function draftContent(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'draft_content_id');
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
        return $this->belongsTo(\Molitor\Language\Models\Language::class, 'language_id');
    }
}

