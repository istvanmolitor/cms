<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class CodeElementType extends TextElementType
{
    public function getName(): string
    {
        return 'code';
    }

    public function getLabel(): string
    {
        return __('Code');
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.code';
    }
}
