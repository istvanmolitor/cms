<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Molitor\Language\Models\Language;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'language_id',
    ];

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'menu_id');
    }

    /**
     * Get only top-level menu items (no parent)
     */
    public function topLevelItems(): HasMany
    {
        return $this->hasMany(MenuItem::class)
            ->whereNull('parent_id')
            ->orderBy('sort');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
