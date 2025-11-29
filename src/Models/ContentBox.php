<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentBox extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'content_region_id',
        'content_id',
        'title',
        'is_visible',
        'sort',
    ];

    protected $casts = [
        'content_region_id' => 'integer',
        'content_id' => 'integer',
        'title' => 'string',
        'is_visible' => 'boolean',
        'sort' => 'integer',
    ];

    public function contentRegion(): BelongsTo
    {
        return $this->belongsTo(ContentRegion::class);
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}

