<?php

namespace Dhii\Espresso\UnitTest\Context;

use Dhii\Espresso\Context\CompositeContext;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Espresso\Context\CompositeContext}.
 *
 * @since 0.1
 */
class CompositeContextTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since 0.1
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Espresso\\Context\\CompositeContext';

    /**
     * Creates a new instance of the test subject.
     *
     * @since 0.1
     *
     * @param array $values The context values. Default: array()
     *
     * @return CompositeContext
     */
    public function constructInstance(array $values = array())
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->new($values);

        return $mock;
    }

    /**
     * Tests the constructor with no arguments to ensure that the context is initialized
     * without any values.
     *
     * @since 0.1
     */
    public function testConstructorNoArgs()
    {
        $subject = $this->constructInstance();

        $this->assertEquals(array(), $subject->this()->value);
    }

    /**
     * Tests the constructor with an array argument to ensure that the values are correctly
     * internally set.
     *
     * @since 0.1
     */
    public function testConstructorWithArgs()
    {
        $values  = array(1, 1, 2, 3, 5, 8, 13);
        $subject = $this->constructInstance($values);

        $this->assertEquals($values, $subject->this()->value);
    }

    /**
     * Tests the value getter to ensure that all values are returned in an array.
     *
     * @since 0.1
     */
    public function testGetValue()
    {
        $values  = array(1, 1, 2, 3, 5, 8, 13);
        $subject = $this->constructInstance($values);

        $this->assertEquals($values, $subject->getValue());
    }

    /**
     * Tests the single value getter to ensure that values for existing keys are returned
     * while non-existing key arguments result in a `null` return.
     *
     * @since 0.1
     */
    public function testGetValueOf()
    {
        $values = array(
            'me'   => 'Myself',
            'you'  => 'Yourself',
            'misc' => 'This is a test',
        );
        $subject = $this->constructInstance($values);

        $this->assertEquals('Yourself', $subject->getValueOf('you'));
        $this->assertEquals(null, $subject->getValueOf('him'));
    }

    /**
     * Tests the value checker method to ensure that it correctly determines if a value
     * exists in the context or not, by key.
     *
     * @since 0.1
     */
    public function testHasValue()
    {
        $values = array(
            'me'   => 'Myself',
            'you'  => 'Yourself',
            'misc' => 'This is a test',
        );
        $subject = $this->constructInstance($values);

        $this->assertTrue($subject->hasValue('me'));
        $this->assertFalse($subject->hasValue('her'));
    }

    /**
     * Tests the single value setter method to ensure that the value is correctly internally set.
     *
     * @since 0.1
     */
    public function testSetValue()
    {
        $values = array(
            'me'  => 'Myself',
            'you' => 'Yourself',
        );
        $subject = $this->constructInstance($values);

        $subject->setValue('him', 'Himself');
        $subject->setValue('we');

        $expected = array_merge($values, array(
            'him' => 'Himself',
            'we'  => null,
        ));

        $this->assertEquals($expected, $subject->this()->value);
    }

    /**
     * Tests the multiple value setter method to ensure that all values are correctly set and
     * all previous values are overwritten.
     *
     * @since 0.1
     */
    public function testSetValues()
    {
        $subject = $this->constructInstance(array(
            'one' => 1,
            'two' => 2,
        ));

        $subject->setValues(array(
            'three' => 3,
            'four'  => 4,
        ));

        $expected = array(
            'three' => 3,
            'four'  => 4,
        );

        $this->assertEquals($expected, $subject->this()->value);
    }

    /**
     * Tests the value removal method to ensure that the value is correctly removed without
     * affecting the rest of the values.
     *
     * @since 0.1
     */
    public function testRemoveValue()
    {
        $values = array(
            'me'   => 'Myself',
            'you'  => 'Yourself',
            'misc' => 'This is a test',
        );
        $subject = $this->constructInstance($values);

        $subject->removeValue('misc');

        $expected = array_diff_assoc($values, array('misc' => 'This is a test'));

        $this->assertEquals($expected, $subject->this()->value);
    }

    /**
     * Tests the method that removes all values to ensure that all values are removed.
     *
     * @since 0.1
     */
    public function testClearValues()
    {
        $subject = $this->constructInstance(array(
            'one' => 1,
            'two' => 2,
        ));

        $subject->clearValues();

        $this->assertEmpty($subject->this()->value);
    }
}
