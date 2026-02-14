<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class QuoteElementType extends TextElementType
{
    public function getName(): string
    {
        return 'quote';
    }

    public function getLabel(): string
    {
        return __('Quote');
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.quote';
    }
}

