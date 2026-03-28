<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentElement extends Model
{
    protected $fillable = [
        'content_id',
        'content_element_type_id',
        'settings',
        'sort',
        'is_visible',
    ];

    protected $casts = [
        'content_id' => 'integer',
        'content_element_type_id' => 'integer',
        'settings' => 'string',
        'sort' => 'integer',
        'is_visible' => 'boolean',
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
