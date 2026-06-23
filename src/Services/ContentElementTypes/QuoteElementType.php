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
            'text' => $data['text'] ?? '',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'text' => 'required|string',
        ];
    }
}
