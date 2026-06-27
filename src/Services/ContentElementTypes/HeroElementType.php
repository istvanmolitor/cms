<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Override;

class HeroElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'hero';
    }

    public function getPackage(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return __('Hero');
    }

    public function prepare(array $data): array
    {
        return [
            'image_src' => isset($data['image_src']) ? (string) $data['image_src'] : '',
            'title' => isset($data['title']) ? (string) $data['title'] : '',
            'lead' => isset($data['lead']) ? (string) $data['lead'] : '',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'image_src' => 'nullable|string',
            'title' => 'required|string|max:255',
            'lead' => 'nullable|string',
        ];
    }

    public function settingsToString(array $settings): string
    {
        return $this->arrayToString([
            $settings['title'],
            $settings['lead'],
        ]);
    }
}
