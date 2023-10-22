<?php

namespace App\Exceptions;

use App\Helpers\ReturnApi;
use Exception;

class ApiException extends Exception
{
    protected $code = 400;
    protected $message = "";

    public function render()
    {
        return ReturnApi::messageReturn(true, $this->message, $this, null, $this->code);
    }
}
