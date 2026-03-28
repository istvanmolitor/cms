<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class IframeElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'iframe';
    }

    public function getLabel(): string
    {
        return __('Iframe');
    }

    public function serialize(array $data): string
    {
        return serialize([
            'url' => $data['url'] ?? '',
            'width' => $data['width'] ?? '100%',
            'height' => $data['height'] ?? '450px',
            'title' => $data['title'] ?? '',
            'allowFullscreen' => $data['allowFullscreen'] ?? true,
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
                'url' => isset($data['url']) ? (string) $data['url'] : '',
                'width' => isset($data['width']) ? (string) $data['width'] : '100%',
                'height' => isset($data['height']) ? (string) $data['height'] : '450px',
                'title' => isset($data['title']) ? (string) $data['title'] : '',
                'allowFullscreen' => isset($data['allowFullscreen']) ? (bool) $data['allowFullscreen'] : true,
            ];
        }

        // Attempt to unserialize with error handling
        $data = @unserialize($content);

        // If unserialize failed, try to handle gracefully
        if ($data === false && $content !== serialize(false)) {
            error_log('Failed to unserialize content in IframeElementType: '.$content);

            return $this->getDefaultSettings();
        }

        return [
            'url' => isset($data['url']) ? (string) $data['url'] : '',
            'width' => isset($data['width']) ? (string) $data['width'] : '100%',
            'height' => isset($data['height']) ? (string) $data['height'] : '450px',
            'title' => isset($data['title']) ? (string) $data['title'] : '',
            'allowFullscreen' => isset($data['allowFullscreen']) ? (bool) $data['allowFullscreen'] : true,
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'url' => 'required|string|url',
            'width' => 'nullable|string',
            'height' => 'nullable|string',
            'title' => 'nullable|string',
            'allowFullscreen' => 'boolean',
        ];
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.iframe';
    }

    public function getDefaultSettings(): array
    {
        return [
            'url' => '',
            'width' => '100%',
            'height' => '450px',
            'title' => '',
            'allowFullscreen' => true,
        ];
    }
}
