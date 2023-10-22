<?php

namespace App\Exceptions;

use App\Helpers\ReturnApi;
use Exception;

class ApiValidationException extends Exception
{
    protected $code = 400;
    protected $message = "";
    protected $errors = [];

    public function __construct($message, $errors = [])
    {
        $this->message = $message;
        $this->errors = $errors;
    }

    public function render()
    {
        return ReturnApi::messageReturn(true, $this->message, $this, $this->errors, $this->code);
    }
}
