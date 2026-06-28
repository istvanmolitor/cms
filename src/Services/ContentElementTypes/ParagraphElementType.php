<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class ParagraphElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'paragraph';
    }

    public function getPackage(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return __('Bekezdés');
    }

    public function prepare(array $data): array
    {
        return [
            'content' => $data['content'] ?? '',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'content' => 'required|string',
        ];
    }

    public function settingsToString(array $settings): string
    {
        return strip_tags((string) ($settings['content'] ?? ''));
    }
}
