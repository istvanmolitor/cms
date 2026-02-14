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
        $data = unserialize($content);
        return [
            'url' => $data['url'] ?? '',
            'width' => $data['width'] ?? '300px',
            'height' => $data['height'] ?? '450px',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'url' => 'required|string',
            'width' => 'required|string',
            'height' => 'required|string',
        ];
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.video';
    }
}

