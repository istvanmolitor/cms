<?php

declare(strict_types=1);

namespace Molitor\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Molitor\User\Models\User;

class Content extends Model
{
    protected $fillable = [
        'user_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contentElements(): HasMany
    {
        return $this->hasMany(ContentElement::class);
    }

    public function page(): HasOne
    {
        return $this->hasOne(Page::class);
    }
}
