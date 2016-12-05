<?php

namespace ankr\Tests\Counter;

use ankr\Counter\Counter;
use ankr\Counter\Countable;
use ankr\Counter\Error\CounterException;
use PHPUnit_Framework_TestCase as TestCase;

class CounterTest extends TestCase
{

    /**
     * Setup
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        Counter::removeAll();
    }

    /**
     * Test exception when getting non-existing counter
     *
     * @return void
     */
    public function testGetException()
    {
        $this->setExpectedException(CounterException::class, 'Counter "foo" not found!');
        Counter::get('foo');
    }

    /**
     * Test exception when counting non-existing counter
     *
     * @return void
     */
    public function testCountException()
    {
        $this->setExpectedException(CounterException::class, 'Counter "foo" not found!');
        Counter::count('foo');
    }

    /**
     * Test get returns instance of Countable
     *
     * @return void
     */
    public function testSetGet()
    {
        Counter::set('foo', 2);
        $counter = Counter::get('foo');

        $this->assertTrue(is_a($counter, Countable::class));
    }

    /**
     * Testing set & count
     *
     * @return void
     */
    public function testSetCount()
    {
        Counter::set('foo', 3);
        $this->assertEquals(3, Counter::count('foo'));

        Counter::set('foo', 2);
        $this->assertEquals(2, Counter::count('foo'));
    }

    /**
     * Test increment
     *
     * @return void
     */
    public function testIncrement()
    {
        Counter::increment('foo');
        $this->assertEquals(Counter::count('foo'), 1);

        Counter::increment('foo', 2);
        Counter::increment('bar');
        $this->assertEquals(Counter::count('foo'), 3);
        $this->assertEquals(Counter::count('bar'), 1);

        Counter::increment('foo', -1);
        Counter::increment('bar', 2);
        $this->assertEquals(Counter::count('foo'), 2);
        $this->assertEquals(Counter::count('bar'), 3);
    }

    /**
     * Test decrement
     *
     * @return void
     */
    public function testDecrement()
    {
        Counter::decrement('foo');
        $this->assertEquals(Counter::count('foo'), -1);

        Counter::decrement('foo', 2);
        Counter::decrement('bar');
        $this->assertEquals(Counter::count('foo'), -3);
        $this->assertEquals(Counter::count('bar'), -1);

        Counter::decrement('foo', -1);
        Counter::decrement('bar', 2);
        $this->assertEquals(Counter::count('foo'), -2);
        $this->assertEquals(Counter::count('bar'), -3);
    }

}
