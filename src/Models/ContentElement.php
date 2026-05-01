<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContentElement extends Model
{
    protected $fillable = [
        'content_id',
        'content_element_type_id',
        'parent_id',
        'settings',
        'sort',
    ];

    protected $casts = [
        'content_id' => 'integer',
        'content_element_type_id' => 'integer',
        'settings' => 'string',
        'sort' => 'integer',
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    public function contentElementType(): BelongsTo
    {
        return $this->belongsTo(ContentElementType::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ContentElement::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ContentElement::class, 'parent_id');
    }
}
