<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'layout',
        'content_id',
        'draft_content_id',
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
}

