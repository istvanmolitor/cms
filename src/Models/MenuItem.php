<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    protected $fillable = [
        'menu_id',
        'label',
        'url',
        'sort',
        'is_external',
        'icon',
        'parent_id',
    ];

    protected $casts = [
        'menu_id' => 'integer',
        'sort' => 'integer',
        'is_external' => 'boolean',
        'parent_id' => 'integer',
    ];

    protected $attributes = [
        'sort' => 0,
        'is_external' => false,
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }
}

