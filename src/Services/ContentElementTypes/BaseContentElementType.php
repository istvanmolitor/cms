<?php

namespace Molitor\Cms\Services\ContentElementTypes;

abstract class BaseContentElementType
{
    abstract public function getName(): string;

    abstract public function getPackage(): string;

    abstract public function getLabel(): string;

    abstract public function prepare(array $data): array;

    public function serialize(array $data): string
    {
        return json_encode($this->prepare($data));
    }

    public function unserialize(string $content): array
    {
        if (empty($content)) {
            return $this->prepare($this->getDefaultSettings());
        }

        $data = json_decode($content, true);
        if (!is_array($data)) {
            return $this->prepare($this->getDefaultSettings());
        }

        return $this->prepare($data);
    }

    public function getCalculated(array $settings): array
    {
        return [];
    }

    public function settingsToString(array $settings): string
    {
        return '';
    }

    public function getDefaultSettings(): array
    {
        return $this->prepare([]);
    }

    /**
     * Get the template path for rendering this element type
     */
    public function getTemplate(): string
    {
        return $this->getPackage() . '::components.content-elements.' . $this->getName();
    }

    /**
     * Get the validation rules for this element type
     *
     * @return array<string, mixed>
     */
    abstract public function getValidationRules(): array;

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

    protected function arrayToString(array $values): string
    {
        $filtered = array_filter(
            array_map(fn($v) => trim((string) $v), $values),
            fn($v) => $v !== ''
        );

        return implode(' ', $filtered);
    }
}
