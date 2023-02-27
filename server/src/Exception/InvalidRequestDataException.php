<?php

namespace App\Exception;

use Exception;

class InvalidRequestDataException extends Exception
{
    private $validationErrors;

    public function __construct(array $validationErrors, $code = 0, Exception $previous = null)
    {
        $this->validationErrors = $validationErrors;
        parent::__construct('Request data is invalid', $code, $previous);
    }

    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }
}
