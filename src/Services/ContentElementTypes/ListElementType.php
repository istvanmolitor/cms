<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class ListElementType extends TextElementType
{
    public function getName(): string
    {
        return 'list';
    }

    public function getLabel(): string
    {
        return __('List');
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.list';
    }
}

