<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class ImageElementType extends TextElementType
{
    public function getName(): string
    {
        return 'image';
    }

    public function getLabel(): string
    {
        return __('Image');
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.image';
    }
}

