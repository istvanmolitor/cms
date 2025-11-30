<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentRegion extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'content_id',
    ];

    protected $casts = [
        'name' => 'string',
    ];

    protected $with = [
        'content.contentElements',
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
