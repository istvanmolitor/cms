<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class TextElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'text';
    }

    public function getLabel(): string
    {
        return __('Text');
    }
}

