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
            'content' => new ContentResource($this->whenLoaded('content')),
            'draftContent' => new ContentResource($this->whenLoaded('draftContent')),
            'authors' => AuthorResource::collection($this->whenLoaded('authors')),
            'pageGroups' => PageGroupResource::collection($this->whenLoaded('pageGroups')),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
