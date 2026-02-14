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
            'text' => $data['text'] ?? '',
            'level' => $data['level'] ?? ''
        ]);
    }

    public function unserialize(string $content): array
    {
        $data = unserialize($content);
        return [
            'text' => $data['text'] ?? '',
            'level' => $data['level'] ?? ''
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
}

