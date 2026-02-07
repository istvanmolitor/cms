<?php

namespace Molitor\Cms\Services;

use Molitor\Cms\Models\ContentElement;
use Molitor\Cms\Repositories\ContentElementTypeRepositoryInterface;
use Molitor\Cms\Services\ContentElementTypes\BaseContentElementType;

class ContentElementHandler
{
    private array $elementTypes = [];

    public function __construct(
        private ContentElementTypeRepositoryInterface $contentElementTypeRepository
    )
    {
    }

    public function addElementType(BaseContentElementType $elementType): void
    {
        $this->elementTypes[$elementType->getType()] = $elementType;
    }

    public function getElementType(string $type): BaseContentElementType|null
    {
        return $this->elementTypes[$type] ?? null;
    }

    public function getOptions(): array
    {
        $options = [];
        /** @var BaseContentElementType $elementType */
        foreach ($this->elementTypes as $elementType) {
            $options[$elementType->getType()] = $elementType->getLabel();
        }
        return $options;
    }

    public function serialize(string $type, array $data): string
    {
        $elementType = $this->getElementType($type);
        return $elementType ? $elementType->serialize($data) : '';
    }

    public function deserialize(string $type, string $content): array
    {
        $elementType = $this->getElementType($type);
        return $elementType ? $elementType->deserialize($content) : [];
    }

    public function getTypeName(ContentElement $contentElement): ?string
    {
        $contentElementType = $this->contentElementTypeRepository->getById($contentElement->content_element_type_id);
        if(empty($contentElementType)) {
            return null;
        }
        return $contentElementType->name;
    }

    public function getContentData(ContentElement $contentElement): array
    {
        $typeName = $this->getTypeName($contentElement);
        if(!$typeName) {
            return [];
        }
        return $this->deserialize($typeName, $contentElement->content);
    }

    public function setContentData(ContentElement $contentElement, array $data): void
    {
        $typeName = $this->getTypeName($contentElement);
        if(!$typeName) {
            return;
        }
        $contentElement->content = $this->serialize($typeName, $data);
    }
}
