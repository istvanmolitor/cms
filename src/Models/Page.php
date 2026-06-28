<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Molitor\Keyword\Traits\HasKeywords;
use Molitor\Language\Models\Language;
use Molitor\Cms\Models\PageType;

class Page extends Model
{
    use HasKeywords;
    protected $fillable = [
        'title',
        'slug',
        'is_published',
        'lead',
        'layout',
        'main_image_url',
        'keywords',
        'content_id',
        'language_id',
        'page_type_id',
    ];

    protected $casts = [
        'content_id' => 'integer',
        'page_type_id' => 'integer',
        'is_published' => 'boolean',
    ];

    protected $attributes = [
        'layout' => 'container',
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function metaData(): HasMany
    {
        return $this->hasMany(PageMeta::class, 'page_id');
    }

    public function pageType(): BelongsTo
    {
        return $this->belongsTo(PageType::class, 'page_type_id');
    }
}
