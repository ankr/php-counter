<?php

namespace ankr\Counter\Error;

use \Exception;

class CounterException extends Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, 400, $previous);
    }
}
