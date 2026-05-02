<?php

declare(strict_types=1);

namespace Molitor\Cms\Data;

class ContentElementDto
{
    private array $children = [];

    /**
     * @param  array<string, mixed>  $settings
     */
    public function __construct(
        public ?int $id,
        public string $type,
        public array $settings,
        public int $sort
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        $contentElement = new self(
            id: $data['id'] ?? null,
            type: $data['type'],
            settings: $data['settings'],
            sort: $data['sort'],
        );

        if (isset($data['content_elements']) && is_array($data['content_elements'])) {
            foreach ($data['content_elements'] as $element) {
                $contentElement->addChild(ContentElementDto::fromArray($element));
            }
        }

        return $contentElement;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'settings' => $this->settings,
            'sort' => $this->sort,
        ];
    }

    public function addChild(ContentElementDto $child)
    {
        $this->children[] = $child;
    }

    public function getChildren(): array
    {
        return $this->children;
    }
}
