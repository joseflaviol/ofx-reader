<?php

namespace OFXReader\Exception;

use Exception;

class IncorrectFileExtensionException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
