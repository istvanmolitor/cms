<?php

declare(strict_types=1);

namespace Molitor\Cms\Data;

class ContentDto
{
    private array $contentElements = [];

    /**
     * @param  array<int, ContentElementDto>  $contentElements
     */
    public function __construct(
        public ?int $id
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
        $content = new self(
            id: $data['id'] ?? null,
        );

        if (isset($data['content_elements']) && is_array($data['content_elements'])) {
            foreach ($data['content_elements'] as $element) {
                $content->addContentElement(ContentElementDto::fromArray($element));
            }
        }

        return $content;
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
