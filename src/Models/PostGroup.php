<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PostGroup extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'layout',
        'lead',
        'main_image_url',
        'keywords',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_post_groups', 'post_group_id', 'post_id');
    }
}
