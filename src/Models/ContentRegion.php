<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContentRegion extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'string',
    ];

    public function contentBoxes(): HasMany
    {
        return $this->hasMany(ContentBox::class);
    }
}
