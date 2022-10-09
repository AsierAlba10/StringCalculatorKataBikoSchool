<?php

namespace Deg540\PHPTestingBoilerplate;

use Exception;

class NegativeNotAllowedException extends Exception
{
    public function __construct(string $negativeNumber)
    {
        parent::__construct("Negative not allowed: " . $negativeNumber);
    }
}