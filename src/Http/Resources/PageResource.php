<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'url' => $this->slug ? route('cms.page.show', ['slug' => $this->slug]) : null,
            'is_published' => $this->is_published,
            'lead' => $this->lead,
            'layout' => $this->layout,
            'main_image_url' => $this->main_image_url,
            'language_id' => $this->language_id,
            'language' => $this->whenLoaded('language'),
            'content' => new ContentResource($this->whenLoaded('content')),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
