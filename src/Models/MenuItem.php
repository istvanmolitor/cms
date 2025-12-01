<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Molitor\Language\Models\TranslatableModel;

class MenuItem extends TranslatableModel
{
    protected $fillable = [
        'menu_id',
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

    public function getTranslationModelClass(): string
    {
        return MenuItemTranslation::class;
    }

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
        return $this->hasMany(MenuItem::class, 'parent_id')
            ->orderBy('sort');
    }

    /**
     * Check if this menu item has children
     */
    public function hasChildren(): bool
    {
        return $this->children()->exists();
    }

    /**
     * Get all descendants recursively
     */
    public function descendants(): HasMany
    {
        return $this->children()->with('descendants');
    }
}

