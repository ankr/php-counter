<?php

namespace ankr\Counter;

use ankr\Counter\Countable;
use ankr\Counter\Error\CounterException;

/**
 * Class used for counting various values
 */
class Counter
{
    /**
     * All counters
     *
     * @var array<\ankr\Counter\Countable>
     */
    protected static $counters = [];

    /**
     * Increment a counter
     *
     * @param string $name
     * @param integer $amount
     * @return void
     */
    public static function increment($name, $amount = 1)
    {
        self::ensure($name);
        self::$counters[$name]->increment($amount);
    }

    /**
     * Alias for `increment`
     */
    public static function inc()
    {
        return call_user_func_array([get_class(), 'increment'], func_get_args());
    }

    /**
     * Decrement a counter
     *
     * @param string $name
     * @param integer $amount
     * @return void
     */
    public static function decrement($name, $amount = 1)
    {
        self::ensure($name);
        self::$counters[$name]->decrement($amount);
    }

    /**
     * Alias for `decrement`
     */
    public static function dec()
    {
        return call_user_func_array([get_class(), 'decrement'], func_get_args());
    }

    /**
     * Get one or all counters
     *
     * @param string|null $name
     * @return integer|array<\ankr\Counter\Countable>
     * @throws \Exception
     */
    public static function get($name = null)
    {
        if ($name === null) {
            return self::$counters;
        }

        if (!array_key_exists($name, self::$counters)) {
            throw new CounterException('Counter "' . $name . '" not found!');
        }

        return self::$counters[$name]->count();
    }

    /**
     * Set value for a counter
     *
     * @param string $name
     * @param integer
     * @return void
     */
    public static function set($name, $value)
    {
        self::ensure($name);
        self::$counters[$name]->set($value);
    }

    /**
     * Reset one counter
     *
     * @param string $name
     * @return void
     */
    public static function reset($name)
    {
        self::$counters[$name]->reset();
    }

    /**
     * Reset all counters
     *
     * @return void
     */
    public static function resetAll()
    {
        foreach (self::$counters as $counter) {
            $counter->reset();
        }
    }

    /**
     * Remove one counter
     *
     * @param string $nam
     * @return void
     */
    public static function remove($name)
    {
        unset(self::$counters[$name]);
    }

    /**
     * Remove all counters
     *
     * @return void
     */
    public static function removeAll()
    {
        self::$counters = [];
    }

    /**
     * Ensure a counter is presnet before we try to inc/dec it
     *
     * @param string $name
     * @return void
     */
    protected static function ensure($name)
    {
        if (!array_key_exists($name, self::$counters)) {
            self::$counters[$name] = new Countable;
        }
    }

}
