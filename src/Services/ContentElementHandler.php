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
}
