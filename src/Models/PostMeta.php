<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostMeta extends Model
{
    protected $table = 'post_meta';

    protected $fillable = [
        'post_id',
        'name',
        'meta_data',
    ];

    protected $casts = [
        'post_id' => 'integer',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
