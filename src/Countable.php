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
     * @return void
     */
    public function increment($amount = 1)
    {
        $this->counter += $amount;
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
     * @return void
     */
    public function decrement($amount = 1)
    {
        $this->counter -= $amount;
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
     * @return void
     */
    public function set($value)
    {
        $this->counter = $value;
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
     * @return void
     */
    public function reset()
    {
        $this->counter = 0;
    }

    /**
     * Set name for counter
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}
