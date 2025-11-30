<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class ListElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'list';
    }

    public function getLabel(): string
    {
        return __('List');
    }
}

