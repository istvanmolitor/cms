<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class ImageElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'image';
    }

    public function getLabel(): string
    {
        return __('Image');
    }
}

