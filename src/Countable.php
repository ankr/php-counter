<?php

namespace ankr\Counter;

use Countable as CountableInterface;

/**
 * Countable
 */
class Countable implements CountableInterface
{
    /**
     * The internal counter
     *
     * @var integer
     */
    protected $counter = 0;

    /**
     * Increment the internal counter
     *
     * @param integer $amount
     * @return $this
     */
    public function increment($amount = 1)
    {
        $this->counter += $amount;

        return $this;
    }

    /**
     * Alias for `increment`
     */
    public function inc()
    {
        return call_user_func_array([$this, 'increment'], func_get_args());
    }

    /**
     * Decrement internal counter
     *
     * @param integer $amount
     * @return $this
     */
    public function decrement($amount = 1)
    {
        $this->counter -= $amount;

        return $this;
    }

    /**
     * Alias for `decrement`
     */
    public function dec()
    {
        return call_user_func_array([$this, 'decrement'], func_get_args());
    }

    /**
     * Set internal counter to specific value
     *
     * @param integer $value
     * @return $this
     */
    public function set($value)
    {
        $this->counter = $value;

        return $this;
    }

    /**
     * Returns the value of internal counter
     *
     * @return integer
     */
    public function count()
    {
        return $this->counter;
    }

    /**
     * Resets internal counter
     *
     * @return $this
     */
    public function reset()
    {
        $this->counter = 0;

        return $this;
    }

}
