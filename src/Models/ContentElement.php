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
    ];

    protected $casts = [
        'content_id' => 'integer',
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}

