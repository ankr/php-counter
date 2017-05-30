<?php

declare(strict_types=1);

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
     * @var \ankr\Counter\Countable[]
     */
    protected static $counters = [];

    /**
     * Increment a counter
     *
     * @param string $name
     * @param integer $amount
     * @return void
     */
    public static function increment(string $name, int $amount = 1): void
    {
        self::ensure($name);
        self::$counters[$name]->increment($amount);
    }

    /**
     * Decrement a counter
     *
     * @param string $name
     * @param integer $amount
     * @return void
     */
    public static function decrement(string $name, int $amount = 1): void
    {
        self::ensure($name);
        self::$counters[$name]->decrement($amount);
    }

    /**
     * Get counted value by name
     *
     * @param string $name
     * @return integer
     * @throws \ankr\Counter\Error\CounterException
     */
    public static function count(string $name): int
    {
        if (!array_key_exists($name, self::$counters)) {
            throw new CounterException('Counter "' . $name . '" not found!');
        }

        return self::$counters[$name]->count();
    }

    /**
     * Return values of all counters
     *
     * @return integer[]
     */
    public static function countAll(): array
    {
        return array_map(function ($counter) {
            return $counter->count();
        }, self::$counters);
    }

    /**
     * Get Countable by name
     *
     * @param string $name
     * @return \ankr\Counter\Countable
     * @throws \ankr\Counter\Error\CounterException
     */
    public static function get(string $name): \ankr\Counter\Countable
    {
        if (!array_key_exists($name, self::$counters)) {
            throw new CounterException('Counter "' . $name . '" not found!');
        }

        return self::$counters[$name];
    }

    /**
     * Get all counters
     *
     * @return \ankr\Counter\Countable[]
     */
    public static function getAll(): array
    {
        return self::$counters;
    }

    /**
     * Set value for a counter
     *
     * @param string $name
     * @param integer $value
     * @return void
     */
    public static function set(string $name, int $value): void
    {
        self::ensure($name);
        self::$counters[$name]->set($value);
    }

    /**
     * Reset one counter
     *
     * @param string $name
     * @return void
     * @throws \ankr\Counter\Error\CounterException
     */
    public static function reset(string $name): void
    {
        if (!array_key_exists($name, self::$counters)) {
            throw new CounterException('Counter "' . $name . '" not found!');
        }

        self::$counters[$name]->reset();
    }

    /**
     * Reset all counters
     *
     * @return void
     */
    public static function resetAll(): void
    {
        foreach (self::$counters as $counter) {
            $counter->reset();
        }
    }

    /**
     * Remove one counter
     *
     * @param string $name
     * @return void
     */
    public static function remove(string $name): void
    {
        unset(self::$counters[$name]);
    }

    /**
     * Remove all counters
     *
     * @return void
     */
    public static function removeAll(): void
    {
        self::$counters = [];
    }

    /**
     * Ensure a counter is present before we try to use it
     *
     * @param string $name
     * @return void
     */
    protected static function ensure(string $name): void
    {
        if (!array_key_exists($name, self::$counters)) {
            $counter = new Countable;
            $counter->setName($name);

            self::$counters[$name] = $counter;
        }
    }

}
