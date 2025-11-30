<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'layout',
        'content_id',
    ];

    protected $casts = [
        'content_id' => 'integer',
    ];

    protected $attributes = [
        'layout' => 'default',
    ];

    public function content(): HasOne
    {
        return $this->hasOne(Content::class);
    }
}

