<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function content(): HasOne
    {
        return $this->hasOne(Content::class);
    }
}
