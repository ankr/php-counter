<?php

namespace ankr\Counter\Error;

use \Exception;

/**
 * CounterException
 */
class CounterException extends Exception
{

    /**
     * Constructor
     *
     * @param string|null $message
     * @param $integer $code
     * @param \Exception $previous
     * @return void
     */
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, 400, $previous);
    }

}
