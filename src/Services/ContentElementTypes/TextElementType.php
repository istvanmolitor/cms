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
            'content' => $data['content'] ?? ''
        ]);
    }

    public function unserialize(string $content): array
    {
        $data = unserialize($content);
        return [
            'content' => $data['content'] ?? '',
        ];
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.text';
    }
}

