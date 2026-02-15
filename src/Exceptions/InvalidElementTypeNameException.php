<?php

namespace Molitor\Cms\Exceptions;

use Exception;

class InvalidElementTypeNameException extends Exception
{
    public function __construct(string $typeName)
    {
        parent::__construct("Invalid element type name: {$typeName}");
    }
}

