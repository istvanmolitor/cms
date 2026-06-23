<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;
use Molitor\Language\Http\Resources\LanguageResource;

class PostResource extends JsonResource
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
            'url' => Route::has('cms.post.show') && $this->slug ? route('cms.post.show', ['slug' => $this->slug]) : null,
            'is_published' => $this->is_published,
            'lead' => $this->lead,
            'layout' => $this->layout,
            'main_image_url' => $this->main_image_url,
            'keywords' => $this->keywords,
            'language_id' => $this->language_id,
            'language' => new LanguageResource($this->whenLoaded('language')),
            'post_type_id' => $this->post_type_id,
            'postType' => new PostTypeResource($this->whenLoaded('postType')),
            'content' => new ContentResource($this->whenLoaded('content')),
            'authors' => AuthorResource::collection($this->whenLoaded('authors')),
            'postGroups' => PostGroupResource::collection($this->whenLoaded('postGroups')),
            'post_meta' => PostMetaResource::collection($this->whenLoaded('postMeta')),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
