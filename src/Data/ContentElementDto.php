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
        public int $sort,
        public bool $isVisible,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            type: $data['type'],
            settings: $data['settings'],
            sort: $data['sort'],
            isVisible: $data['is_visible'],
        );
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
            'is_visible' => $this->isVisible,
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
