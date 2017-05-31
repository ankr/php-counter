<?php

declare(strict_types=1);

namespace ankr\Tests\Counter;

use ankr\Counter\Countable;
use Countable as CountableInterface;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * CountableTest
 */
class CountableTest extends TestCase
{

    /**
     * Test constructor works with and without values
     *
     * @return void
     */
    public function testConstructor(): void
    {
        $counter = new Countable;
        $this->assertEquals(0, $counter->count());
        $this->assertEquals(null, $counter->getName());

        $counter = new Countable(2, 'foo');
        $this->assertEquals(2, $counter->count());
        $this->assertEquals('foo', $counter->getName());
    }

    /**
     * Test setting specific value
     *
     * @return void
     */
    public function testSet(): void
    {
        $counter = new Countable;
        $this->assertEquals(0, $counter->count());

        $counter->set(2);
        $this->assertEquals(2, $counter->count());
    }

    /**
     * Test set/get name
     *
     * @return void
     */
    public function testName(): void
    {
        $counter = new Countable;
        $this->assertEquals(null, $counter->getName());

        $counter->setName('foo');
        $this->assertEquals('foo', $counter->getName());
    }

    /**
     * Test incrementing
     *
     * @return void
     */
    public function testIncrement(): void
    {
        $counter = new Countable(3);

        $counter->increment();
        $this->assertEquals(4, $counter->count());

        $counter->increment(2);
        $this->assertEquals(6, $counter->count());
    }

    /**
     * Test decrementing
     *
     * @return void
     */
    public function testDecrement(): void
    {
        $counter = new Countable(3);

        $counter->decrement();
        $this->assertEquals(2, $counter->count());

        $counter->decrement(3);
        $this->assertEquals(-1, $counter->count());
    }

    /**
     * Test reset
     *
     * @return void
     */
    public function testReset(): void
    {
        $counter = new Countable(2);
        $this->assertEquals(2, $counter->count());

        $counter->reset();
        $this->assertEquals(0, $counter->count());
    }

    /**
     * Test implementation of \Countable interface
     *
     * @return void
     */
    public function testIsCountable(): void
    {
        $counter = new Countable(2);

        $this->assertInstanceOf(CountableInterface::class, $counter);
        $this->assertEquals(2, count($counter));
    }

}
