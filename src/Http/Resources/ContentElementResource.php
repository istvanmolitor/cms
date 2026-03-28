<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Molitor\Cms\Models\ContentElement;
use Molitor\Cms\Services\ContentHandler;

class ContentElementResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var ContentHandler $handler */
        $handler = app(ContentHandler::class);

        /** @var ContentElement $contentElement */
        $contentElement = $this->resource;

        return [
            'id' => $this->id,
            'type' => $handler->getTypeName($contentElement),
            'settings' => $handler->getContentData($contentElement),
            // 'children' => ContentElementResource::collection($this->whenLoaded('children')),
            'sort' => $this->sort,
            'is_visible' => $this->is_visible,
        ];
    }
}
