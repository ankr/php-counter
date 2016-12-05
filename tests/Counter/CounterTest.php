<?php

namespace ankr\Tests\Counter;

use ankr\Counter\Countable;
use ankr\Counter\Counter;
use ankr\Counter\Error\CounterException;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * CounterTest
 */
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
     * Test exception when resetting non-existing counter
     *
     * @return void
     */
    public function testResetException()
    {
        $this->setExpectedException(CounterException::class, 'Counter "foo" not found!');
        Counter::reset('foo');
    }

    /**
     * Test get returns instance of Countable
     *
     * @return void
     */
    public function testSetGet()
    {
        Counter::set('foo', 2);
        $this->assertInstanceOf(Countable::class, Counter::get('foo'));
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
     * Test getAll
     *
     * @return void
     */
    public function testGetAll()
    {
        Counter::set('foo', 2);
        Counter::increment('bar');

        $expected = ['foo' => 2, 'bar' => 1];

        $counters = Counter::getAll();
        $result = array_map(function ($counter) {
            $this->assertInstanceOf(\Countable::class, $counter);
            return $counter->count();
        }, $counters);

        $this->assertEquals($expected, $result);
    }

    /**
     * Test countAll
     *
     * @return void
     */
    public function testCountAll()
    {
        Counter::set('foo', 2);
        Counter::increment('bar');

        $expected = ['foo' => 2, 'bar' => 1];
        $this->assertEquals($expected, Counter::countAll());
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

    /**
     * Test reset
     *
     * @return void
     */
    public function testReset()
    {
        Counter::set('foo', 2);
        $this->assertEquals(2, Counter::count('foo'));

        Counter::reset('foo');
        $this->assertEquals(0, Counter::count('foo'));
    }

    /**
     * Test resetAll
     *
     * @return void
     */
    public function testResetAll()
    {
        Counter::set('foo', 1);
        Counter::set('bar', 2);

        Counter::resetAll();

        $this->assertEquals(['foo' => 0, 'bar' => 0], Counter::countAll());
    }

    /**
     * Test remove
     *
     * @return void
     */
    public function testRemove()
    {
        Counter::set('foo', 1);
        Counter::set('bar', 2);
        Counter::remove('foo');

        $this->assertEquals(['bar'], array_keys(Counter::getAll()));
    }

    /**
     * Test removeAll
     *
     * @return void
     */
    public function testRemoveAll()
    {
        Counter::set('foo', 1);
        Counter::set('bar', 2);
        Counter::removeAll();

        $this->assertEquals(0, count(Counter::getAll()));
    }

}
