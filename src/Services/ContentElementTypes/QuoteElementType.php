<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Override;

class QuoteElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'quote';
    }

    public function getPackage(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return __('Quote');
    }

    public function prepare(array $data): array
    {
        return [
            'quote' => $data['quote'] ?? '',
            'author' => $data['author'] ?? '',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'quote' => 'required|string',
            'author' => 'string',
        ];
    }

    public function settingsToString(array $settings): string
    {
        return $this->arrayToString([
            $settings['quote'],
            $settings['author'],
        ]);
    }
}
