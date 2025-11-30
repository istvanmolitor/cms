<?php

namespace Molitor\Cms\Services\ContentElementTypes;

abstract class BaseContentElementType
{
    abstract public function getType(): string;

    abstract public function getLabel(): string;

    abstract public function getFormFields(): array;

    /**
     * Convert form data to a string for database storage
     */
    abstract public function serialize(array $data): string;

    /**
     * Convert stored string back to form data
     */
    abstract public function deserialize(string $content): array;
}
