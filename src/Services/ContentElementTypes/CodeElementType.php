<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class CodeElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'code';
    }

    public function getLabel(): string
    {
        return __('Code');
    }
}

