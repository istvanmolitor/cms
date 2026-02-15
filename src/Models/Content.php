<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Content extends Model
{
    protected $fillable = [
    ];

    public function contentElements(): HasMany
    {
        return $this->hasMany(ContentElement::class);
    }
}
