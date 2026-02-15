<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class ListElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'list';
    }

    public function getLabel(): string
    {
        return __('List');
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.list';
    }

    public function serialize(array $data): string
    {
        return serialize([
            'items' => $data['items'] ?? [],
        ]);
    }

    public function unserialize(string $content): array
    {
        // Handle empty content
        if (empty($content)) {
            return $this->getDefaultSettings();
        }

        // Check if content is JSON (for backward compatibility or migration)
        if ($this->isJson($content)) {
            $data = json_decode($content, true);
            return [
                'items' => $data['items'] ?? [],
            ];
        }

        // Attempt to unserialize with error handling
        $data = @unserialize($content);

        // If unserialize failed, try to handle gracefully
        if ($data === false && $content !== serialize(false)) {
            error_log("Failed to unserialize content in ListElementType: " . $content);
            return $this->getDefaultSettings();
        }

        return [
            'items' => $data['items'] ?? [],
        ];
    }

    /**
     * Check if a string is valid JSON
     */
    private function isJson(string $string): bool
    {
        if (empty($string)) {
            return false;
        }
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function getDefaultSettings(): array
    {
        return [
            'items' => [],
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'items' => 'required|array',
        ];
    }
}

