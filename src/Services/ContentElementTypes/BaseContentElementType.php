<?php

namespace Molitor\Cms\Services\ContentElementTypes;

abstract class BaseContentElementType
{
    abstract public function getType(): string;

    abstract public function getLabel(): string;
}
