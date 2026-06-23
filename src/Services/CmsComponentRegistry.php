<?php

namespace Molitor\Cms\Services;

use InvalidArgumentException;

class CmsComponentRegistry
{
    /** @var array<string, CmsComponent> */
    private array $components = [];

    public function register(CmsComponent $component): void
    {
        $this->components[$component->getName()] = $component;
    }

    public function get(string $name): CmsComponent
    {
        if (! array_key_exists($name, $this->components)) {
            throw new InvalidArgumentException("CmsComponent '{$name}' is not registered.");
        }

        return $this->components[$name];
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->components);
    }

    /** @return array<string, CmsComponent> */
    public function all(): array
    {
        return $this->components;
    }

    public function render(string $name): string
    {
        if($this->has($name)) {
            return $this->get($name)->render();
        }
        return '';
    }
}
