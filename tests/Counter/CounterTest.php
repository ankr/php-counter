<?php

namespace ankr\Tests\Counter;

use ankr\Counter\Counter;
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
     * Test exception for non-existing counter
     *
     * @return void
     */
    public function testGetException()
    {
        $this->setExpectedException(CounterException::class, 'Counter "foo" not found!');
        Counter::get('foo');
    }

    /**
     * Testing get & set
     *
     * @return void
     */
    public function testSetGet()
    {
        Counter::set('foo', 3);
        $this->assertEquals(3, Counter::get('foo'));

        Counter::inc('foo');
        $this->assertEquals(4, Counter::get('foo'));

        Counter::set('foo', 3);
        $this->assertEquals(3, Counter::get('foo'));
    }

    /**
     * Test increment
     *
     * @return void
     */
    public function testIncrement()
    {
        Counter::inc('foo');
        $this->assertEquals(Counter::get('foo'), 1);

        Counter::inc('foo', 2);
        Counter::inc('bar');
        $this->assertEquals(Counter::get('foo'), 3);
        $this->assertEquals(Counter::get('bar'), 1);

        Counter::inc('foo', -1);
        Counter::inc('bar', 2);
        $this->assertEquals(Counter::get('foo'), 2);
        $this->assertEquals(Counter::get('bar'), 3);
    }

    /**
     * Test decrement
     *
     * @return void
     */
    public function testDecrement()
    {
        Counter::inc('foo');
        $this->assertEquals(Counter::get('foo'), 1);

        Counter::inc('foo', 2);
        Counter::inc('bar');
        $this->assertEquals(Counter::get('foo'), 3);
        $this->assertEquals(Counter::get('bar'), 1);

        Counter::inc('foo', -1);
        Counter::inc('bar', 2);
        $this->assertEquals(Counter::get('foo'), 2);
        $this->assertEquals(Counter::get('bar'), 3);
    }

}
