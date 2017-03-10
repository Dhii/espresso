<?php

namespace Dhii\Espresso\Test\Term;

use Dhii\Espresso\Context\RawContext;
use Dhii\Espresso\Term\LiteralTerm;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Espresso\Term\LiteralTerm}.
 *
 * @since [*next-version*]
 */
class LiteralTermTest extends TestCase
{
    /**
     * Tests the constructor to assert if the value is correctly set.
     *
     * @since [*next-version*]
     */
    public function testConstructor()
    {
        $subject = new LiteralTerm(9);

        $this->assertEquals(9, $this->reflect($subject)->value);
    }

    /**
     * Tests the value getter to assert if the correct value is returned.
     *
     * @since [*next-version*]
     */
    public function testGetValue()
    {
        $subject = new LiteralTerm(9);

        $this->assertEquals(9, $subject->getValue());
    }

    /**
     * Tests the value setter to assert if the correct value is set.
     *
     * @since [*next-version*]
     */
    public function testSetValue()
    {
        $subject = new LiteralTerm(0);

        $subject->setValue(9);

        $this->assertEquals(9, $this->reflect($subject)->value);
    }

    /**
     * Tests the evaluation without a context to assert that the term evaluates correctly.
     *
     * @since [*next-version*]
     */
    public function testEvaluateNoContext()
    {
        $subject = new LiteralTerm(9);

        $this->assertEquals(9, $subject->evaluate());
    }

    /**
     * Tests the evaluation with a context to assert that the term evaluates correctly.
     *
     * @since [*next-version*]
     */
    public function testEvaluateWithContext()
    {
        $subject = new LiteralTerm(9);
        $context = new RawContext(18);

        $this->assertEquals(9, $subject->evaluate($context));
    }
}
