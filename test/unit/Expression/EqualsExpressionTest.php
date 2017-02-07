<?php

namespace Dhii\Espresso\Test\Expression;

use Dhii\Espresso\Context\CompositeContext;
use Dhii\Espresso\Expression\EqualsExpression;
use Dhii\Espresso\Term\LiteralTerm;
use Dhii\Espresso\Term\VariableTerm;
use ReflectionClass;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Espresso\Expression\EqualsExpression}.
 *
 * @since [*next-version*]
 */
class EqualsExpressionTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Espresso\\Expression\\EqualsExpression';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return EqualsExpression
     */
    public function createInstance(/* $args */)
    {
        $reflection = new ReflectionClass(static::TEST_SUBJECT_CLASSNAME);
        $instance   = $reflection->newInstanceArgs(func_get_args());

        return $instance;
    }

    /**
     * Tests the evaluation without any terms.
     *
     * @since [*next-version*]
     */
    public function testEvaluateNoTerms()
    {
        $subject = $this->createInstance();

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests the evaluation with only one term.
     *
     * @since [*next-version*]
     */
    public function testEvaluateOneTerm()
    {
        $subject = $this->createInstance(
            new LiteralTerm(5)
        );

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests the evaluation with two equal terms.
     *
     * @since [*next-version*]
     */
    public function testEvaluateTwoTermsEqual()
    {
        $subject = $this->createInstance(
            new LiteralTerm(5),
            new LiteralTerm(5)
        );

        $this->assertTrue($subject->evaluate());
    }

    /**
     * Tests the evaluation with two equal terms with a context.
     *
     * @since [*next-version*]
     */
    public function testEvaluateTwoTermsContextEqual()
    {
        $subject = $this->createInstance(
            new LiteralTerm(5),
            new VariableTerm('x')
        );

        $ctx = new CompositeContext(array('x' => 5));

        $this->assertTrue($subject->evaluate($ctx));
    }

    /**
     * Tests the evaluation with two different terms.
     *
     * @since [*next-version*]
     */
    public function testEvaluateTwoTermsDifferent()
    {
        $subject = $this->createInstance(
            new LiteralTerm(5),
            new LiteralTerm(9)
        );

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests the evaluation with two different terms with a context.
     *
     * @since [*next-version*]
     */
    public function testEvaluateTwoTermsContextDifferent()
    {
        $subject = $this->createInstance(
            new LiteralTerm(5),
            new VariableTerm('x')
        );

        $ctx = new CompositeContext(array('x' => 3));

        $this->assertFalse($subject->evaluate($ctx));
    }

    /**
     * Tests the evaluation with three equal terms.
     *
     * @since [*next-version*]
     */
    public function testEvaluateThreeTermsEqual()
    {
        $subject = $this->createInstance(
            new LiteralTerm(5),
            new LiteralTerm(5),
            new LiteralTerm(5)
        );

        $this->assertTrue($subject->evaluate());
    }

    /**
     * Tests the evaluation with three equal terms with context.
     *
     * @since [*next-version*]
     */
    public function testEvaluateThreeTermsContextEqual()
    {
        $subject = $this->createInstance(
            new LiteralTerm(5),
            new VariableTerm('x'),
            new VariableTerm('y')
        );

        $ctx = new CompositeContext(array(
            'x' => 5,
            'y' => 5,
        ));

        $this->assertTrue($subject->evaluate($ctx));
    }

    /**
     * Tests the evaluation with three different terms.
     *
     * @since [*next-version*]
     */
    public function testEvaluateThreeTermsDifferent()
    {
        $subject = $this->createInstance(
            new LiteralTerm(5),
            new LiteralTerm(5),
            new LiteralTerm(9)
        );

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests the evaluation with three different terms and context.
     *
     * @since [*next-version*]
     */
    public function testEvaluateThreeTermsContextDifferent()
    {
        $subject = $this->createInstance(
            new LiteralTerm(5),
            new VariableTerm('x'),
            new VariableTerm('y')
        );

        $ctx = new CompositeContext(array(
            'x' => 5,
            'y' => 0,
        ));

        $this->assertFalse($subject->evaluate($ctx));
    }
}
