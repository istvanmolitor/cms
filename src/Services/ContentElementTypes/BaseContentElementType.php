<?php

namespace Molitor\Cms\Services\ContentElementTypes;

abstract class BaseContentElementType
{
    abstract public function getName(): string;

    abstract public function getLabel(): string;

    /**
     * Convert form data to a string for database storage
     */
    abstract public function serialize(array $data): string;

    /**
     * Convert stored string back to form data
     */
    abstract public function unserialize(string $content): array;

    /**
     * Get the template path for rendering this element type
     */
    abstract public function getTemplate(): string;

    /**
     * Get the validation rules for this element type
     *
     * @return array<string, mixed>
     */
    public function getValidationRules(): array
    {
        return [
            'content' => 'sometimes|string',
        ];
    }
}
