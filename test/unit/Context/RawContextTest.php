<?php

namespace Dhii\Espresso\UnitTest\Context;

use \Dhii\Espresso\Context\RawContext;
use \Exception;
use \Xpmock\TestCase;

/**
 * Tests {@see Dhii\Espresso\Context\RawContext}.
 *
 * @since [*next-version*]
 */
class RawContextTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Espresso\\Context\\RawContext';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param mixed $value The context value
     *
     * @return RawContext
     */
    public function constructInstance($value)
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->new($value);

        return $mock;
    }

    /**
     * Tests the constructor to ensure that the given value argument is correctly set.
     *
     * @since [*next-version*]
     */
    public function testConstructor()
    {
        $subject = $this->constructInstance('some string');

        $this->assertEquals('some string', $subject->this()->value);
    }

    /**
     * Tests the value getter to ensure that the correct value is retrieved.
     *
     * @since [*next-version*]
     */
    public function testGetValue()
    {
        $subject = $this->constructInstance(null);
        $subject->this()->value = PHP_VERSION;

        $this->assertEquals(PHP_VERSION, $subject->getValue());
    }

    /**
     * Tests the value setter to ensure that the value is correctly set.
     *
     * @since [*next-version*]
     */
    public function testSetValue()
    {
        $subject = $this->constructInstance(null);
        $object  = new Exception('exception for testing');

        $subject->setValue($object);

        $this->assertTrue($object === $subject->this()->value);
    }
}
