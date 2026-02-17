<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class ImageElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'image';
    }

    public function getLabel(): string
    {
        return __('Image');
    }

    public function serialize(array $data): string
    {
        return serialize([
            'src' => isset($data['src']) ? (string)$data[ 'src'] : '',
            'alt' => isset($data['alt']) ? (string)$data['alt'] : '',
            'width' => isset($data['width']) ? (string)$data['width'] : null,
            'height' => isset($data['height']) ? (string)$data['height'] : null,
            'alignment' => isset($data['alignment']) ? (string)$data['alignment'] : 'left',
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
                'src' => isset($data['src']) ? (string)$data['src'] : '',
                'alt' => isset($data['alt']) ? (string)$data['alt'] : '',
                'width' => isset($data['width']) ? (string)$data['width'] : null,
                'height' => isset($data['height']) ? (string)$data['height'] : null,
                'alignment' => isset($data['alignment']) ? (string)$data['alignment'] : 'left',
            ];
        }

        // Attempt to unserialize with error handling
        $data = @unserialize($content);

        // If unserialize failed, try to handle gracefully
        if ($data === false && $content !== serialize(false)) {
            error_log("Failed to unserialize content in ImageElementType: " . $content);
            return $this->getDefaultSettings();
        }

        return [
            'src' => isset($data['src']) ? (string)$data['src'] : '',
            'alt' => isset($data['alt']) ? (string)$data['alt'] : '',
            'width' => isset($data['width']) ? (string)$data['width'] : null,
            'height' => isset($data['height']) ? (string)$data['height'] : null,
            'alignment' => isset($data['alignment']) ? (string)$data['alignment'] : 'left',
        ];
    }


    public function getDefaultSettings(): array
    {
        return [
            'src' => '',
            'alt' => '',
            'width' => null,
            'height' => null,
            'alignment' => 'left',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'src' => 'required|string',
            'alt' => 'string',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'alignment' => 'string|in:left,center,right',
        ];
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.image';
    }
}

