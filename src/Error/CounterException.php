<?php

declare(strict_types=1);

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
     */
    public function __construct(string $message = null, int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, 400, $previous);
    }

}
