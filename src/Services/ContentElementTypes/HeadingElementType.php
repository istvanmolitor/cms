<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class HeadingElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'heading';
    }

    public function getLabel(): string
    {
        return __('Heading');
    }
}

