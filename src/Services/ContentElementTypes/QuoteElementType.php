<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class QuoteElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'quote';
    }

    public function getLabel(): string
    {
        return __('Quote');
    }
}

