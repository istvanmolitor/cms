<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class VideoElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'video';
    }

    public function getLabel(): string
    {
        return __('Video');
    }

    public function serialize(array $data): string
    {
        return serialize([
            'url' => $data['url'] ?? '',
            'width' => $data['width'] ?? '300px',
            'height' => $data['height'] ?? '450px',
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
                'url' => isset($data['url']) ? (string)$data['url'] : '',
                'width' => isset($data['width']) ? (string)$data['width'] : '300px',
                'height' => isset($data['height']) ? (string)$data['height'] : '450px',
            ];
        }

        // Attempt to unserialize with error handling
        $data = @unserialize($content);

        // If unserialize failed, try to handle gracefully
        if ($data === false && $content !== serialize(false)) {
            error_log("Failed to unserialize content in VideoElementType: " . $content);
            return $this->getDefaultSettings();
        }

        return [
            'url' => isset($data['url']) ? (string)$data['url'] : '',
            'width' => isset($data['width']) ? (string)$data['width'] : '300px',
            'height' => isset($data['height']) ? (string)$data['height'] : '450px',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'url' => 'required|string|url',
            'width' => 'nullable|string',
            'height' => 'nullable|string',
        ];
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.video';
    }

    public function getDefaultSettings(): array
    {
        return [
            'url' => '',
            'width' => '300px',
            'height' => '450px',
        ];
    }
}

