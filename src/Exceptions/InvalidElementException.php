<?php

namespace Molitor\Cms\Exceptions;

use Exception;

class InvalidElementException extends Exception
{
    public function __construct(string $message = "Invalid element")
    {
        parent::__construct($message);
    }
}

