<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentElement extends Model
{
    protected $fillable = [
        'content_id',
        'type',
        'content',
        'sort',
        'is_visible',
    ];

    protected $casts = [
        'content_id' => 'integer',
        'type' => 'string',
        'content' => 'string',
        'sort' => 'integer',
        'is_visible' => 'boolean',
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}

