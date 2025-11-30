<?php

namespace Molitor\Cms\Services;

use Molitor\Cms\Services\ContentElementTypes\BaseContentElementType;

class ContentElementHandler
{
    private array $elementTypes = [];

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

    public function getFormFields(string $type): array
    {
        $elementType = $this->getElementType($type);
        return $elementType ? $elementType->getFormFields() : [];
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
}
