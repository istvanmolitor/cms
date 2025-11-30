<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

class Menu extends Model
{
    protected $fillable = [
        'name',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class);
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

    /**
     * Get hierarchical menu items with children
     */
    public function getHierarchicalItems(): Collection
    {
        return $this->items()
            ->with('children')
            ->whereNull('parent_id')
            ->orderBy('sort')
            ->get();
    }
}

