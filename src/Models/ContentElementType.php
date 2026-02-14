<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class ContentElementType extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'string',
    ];

    public $timestamps = false;
}
