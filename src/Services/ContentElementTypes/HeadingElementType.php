<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class HeadingElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'heading';
    }

    public function getLabel(): string
    {
        return __('Heading');
    }

    public function serialize(array $data): string
    {
        return serialize([
            'text' => isset($data['text']) ? (string)$data[ 'text'] : '',
            'level' => isset($data['level']) ? (int)$data['level'] : 1,
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
                'level' => $data['level'] ?? 1
            ];
        }

        // Attempt to unserialize with error handling
        $data = @unserialize($content);

        // If unserialize failed, try to handle gracefully
        if ($data === false && $content !== serialize(false)) {
            // Log the error or handle it as needed
            error_log("Failed to unserialize content in HeadingElementType: " . $content);
            return $this->getDefaultSettings();
        }

        return [
            'text' => $data['text'] ?? '',
            'level' => $data['level'] ?? 1
        ];
    }


    public function getValidationRules(): array
    {
        return [
            'text' => 'required|string',
            'level' => 'required|integer|min:1|max:6',
        ];
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.heading';
    }

    public function getDefaultSettings(): array
    {
        return [
            'text' => '',
            'level' => 1,
        ];
    }
}

