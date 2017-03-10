<?php

namespace Dhii\Espresso\Test\Term;

use Dhii\Espresso\Context\CompositeContext;
use Dhii\Espresso\Context\RawContext;
use Dhii\Espresso\Term\VariableTerm;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Espresso\Term\VariableTerm}.
 *
 * @since [*next-version*]
 */
class VariableTermTest extends TestCase
{
    public function testConstructor()
    {
        $subject = new VariableTerm('foobar');

        $this->assertEquals('foobar', $this->reflect($subject)->identifier);
    }

    /**
     * Tests the identifier getter to assert if the correct identifier is returned.
     *
     * @since [*next-version*]
     */
    public function testGetIdentifier()
    {
        $subject = new VariableTerm('foobar');

        $this->assertEquals('foobar', $subject->getIdentifier());
    }

    /**
     * Tests the identifier setter to assert if the correct identifier is set.
     *
     * @since [*next-version*]
     */
    public function testSetIdentifier()
    {
        $subject = new VariableTerm('');

        $subject->setIdentifier('foobar');

        $this->assertEquals('foobar', $this->reflect($subject)->identifier);
    }

    /**
     * Tests the evaluation without a context to assert that an exception is thrown.
     *
     * @since [*next-version*]
     */
    public function testEvaluateNoContext()
    {
        $subject = new VariableTerm('foobar');

        $this->setExpectedException('Dhii\\Evaluable\\EvaluationExceptionInterface');

        $subject->evaluate();
    }

    /**
     * Tests the evaluation with an invalid context to assert that the term throws an exception.
     *
     * @since [*next-version*]
     */
    public function testEvaluateWithInvalidContext()
    {
        $subject = new VariableTerm('foobar');
        $context = new RawContext(18);

        $this->setExpectedException('Dhii\\Evaluable\\EvaluationExceptionInterface');

        $subject->evaluate($context);
    }

    /**
     * Tests the evaluation with a context that does not specify a value for the term's identifier to assert that the
     * term throws an exception.
     *
     * @since [*next-version*]
     */
    public function testEvaluateWithMissingContextValue()
    {
        $subject = new VariableTerm('foobar');
        $context = new CompositeContext(array(
            'x' => 5,
            'y' => 3,
        ));

        $this->setExpectedException('Dhii\\Evaluable\\EvaluationExceptionInterface');

        $subject->evaluate($context);
    }

    /**
     * Tests the evaluation with a valid context to assert that the term evaluates correctly.
     *
     * @since [*next-version*]
     */
    public function testEvaluateWithContext()
    {
        $subject = new VariableTerm('foobar');
        $context = new CompositeContext(array(
            'x'      => 5,
            'y'      => 3,
            'foobar' => 22,
        ));

        $this->assertEquals(22, $subject->evaluate($context));
    }
}
