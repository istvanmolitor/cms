<?php

namespace Molitor\Cms\Services;

abstract class CmsComponent
{
    abstract public function getName(): string;

    abstract public function getLabel(): string;

    abstract public function getPackage(): string;

    abstract public function getVariables(): string;

    public function getView(): string
    {
        return $this->getPackage() . '::components.cms.' . $this->getName();
    }

    public function render(): string
    {
        return view($this->getView(), $this->getVariables())->render();
    }
}
