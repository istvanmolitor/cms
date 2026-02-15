<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class TextElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'text';
    }

    public function getLabel(): string
    {
        return __('Text');
    }

    public function serialize(array $data): string
    {
        return serialize([
            'text' => $data['text'] ?? ''
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
                'text' => $data['text'] ?? '',
            ];
        }

        // Attempt to unserialize with error handling
        $data = @unserialize($content);

        // If unserialize failed, try to handle gracefully
        if ($data === false && $content !== serialize(false)) {
            error_log("Failed to unserialize content in TextElementType: " . $content);
            return $this->getDefaultSettings();
        }

        return [
            'text' => $data['text'] ?? '',
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
            'text' => '',
        ];
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.text';
    }

    public function getValidationRules(): array
    {
        return [
            'text' => 'required|string',
        ];
    }
}

