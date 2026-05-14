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

    abstract public function getDefaultSettings(): array;

    /**
     * Get the template path for rendering this element type
     */
    abstract public function getTemplate(): string;

    /**
     * Get the validation rules for this element type
     *
     * @return array<string, mixed>
     */
    abstract public function getValidationRules(): array;

    /**
     * Prepare data for the view
     */
    public function prepare(array $settings): array
    {
        return [
            'settings' => $settings,
        ];
    }

    /**
     * Check if a string is valid JSON
     */
    protected function isJson(string $string): bool
    {
        if (empty($string)) {
            return false;
        }
        json_decode($string);

        return json_last_error() === JSON_ERROR_NONE;
    }
}
