<?php

declare(strict_types=1);

namespace Molitor\Cms\Data;

class ContentDto
{
    /**
     * @param  array<int, ContentElementDto>  $contentElements
     */
    public function __construct(
        public ?int $id,
        private array $contentElements,
    ) {}

    /**
     * @return array<int, ContentElementDto>
     */
    public function getContentElements(): array
    {
        return $this->contentElements;
    }

    public function addContentElement(ContentElementDto $contentElement): void
    {
        $this->contentElements[] = $contentElement;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        $contentElements = [];

        if (isset($data['content_elements']) && is_array($data['content_elements'])) {
            foreach ($data['content_elements'] as $element) {
                $contentElements[] = ContentElementDto::fromArray($element);
            }
        }

        return new self(
            id: $data['id'] ?? null,
            contentElements: $contentElements,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'content_elements' => array_map(
                fn (ContentElementDto $element) => $element->toArray(),
                $this->contentElements
            ),
        ];
    }
}
