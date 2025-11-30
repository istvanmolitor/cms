<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class VideoElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'video';
    }

    public function getLabel(): string
    {
        return __('Video');
    }
}

