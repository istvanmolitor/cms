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
            'link' => isset($data['link']) ? (string) $data['link'] : '',
            'link_text' => isset($data['link_text']) ? (string) $data['link_text'] : '',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'image_src' => 'nullable|string',
            'title' => 'required|string|max:255',
            'lead' => 'nullable|string',
            'link' => 'nullable|string',
            'link_text' => 'nullable|string|max:255',
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
