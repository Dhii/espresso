<?php

namespace Dhii\Espresso\Test;

use \Dhii\Espresso\AbstractGenericExpression;
use \Dhii\Evaluable\EvaluableInterface;
use \Xpmock\TestCase;

/**
 * Tests {@see \Dhii\Espress\Expression\AbstractGenericExpression}.
 *
 * @since [*next-version*]
 */
class AbstractGenericExpressionTest extends TestCase
{
    /**
     * The instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @var AbstractGenericExpression
     */
    protected $instance;

    /**
     * Creates a new instance of the test subject for testing.
     *
     * @since [*next-version*]
     *
     * @param array $terms [optional] An array of expression terms. Default: array()
     *
     * @return AbstractGenericExpression The new testing instance.
     */
    public function createInstance(array $terms = array())
    {
        $mock = $this->mock('Dhii\\Espresso\\AbstractGenericExpression')
            ->evaluate(0) // return value does not matter
            ->new();

        $ref        = $this->reflect($mock);
        $ref->terms = $terms;

        return $mock;
    }

    /**
     * Creates a mock expression term for testing purposes.
     *
     * @since [*next-version*]
     *
     * @param mixed $return [optional] The value the term evaluates to. Default: null
     *
     * @return EvaluableInterface The new mocked term instance.
     */
    public function mockEvaluable($return = null)
    {
        return $this->mock('Dhii\\Evaluable\\EvaluableInterface')->evaluate($return)->new();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function setUp()
    {
        $this->instance = $this->createInstance();
    }

    /**
     * Tests whether a valid instance of a the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $this->assertInstanceOf('Dhii\\Espresso\\AbstractExpression', $this->instance, 'Subject instance is not valid.');
    }

    /**
     * Tests whether terms are correctly added to the expression.
     *
     * @since [*next-version*]
     */
    public function testAddTerm()
    {
        $term = $this->mockEvaluable();
        $this->instance->addTerm($term);

        $this->assertEquals(array($term), $this->reflect($this->instance)->terms);
    }

    /**
     * Tests whether terms are correctly removed from the expression.
     *
     * @since [*next-version*]
     */
    public function testRemoveTerm()
    {
        $terms = array(
            $this->mockEvaluable(),
            $this->mockEvaluable(),
            $this->mockEvaluable(),
        );

        $this->reflect($this->instance)->terms = $terms;

        $this->instance->removeTerm(1);
        unset($terms[1]);

        $this->assertEquals($terms, $this->reflect($this->instance)->terms);
    }

    /**
     * Tests whether terms are correctly set to the expression.
     *
     * @since [*next-version*]
     */
    public function testSetTerms()
    {
        $terms = array(
            $this->mockEvaluable(),
            $this->mockEvaluable(),
            $this->mockEvaluable(),
        );

        $this->instance->setTerms($terms);

        $this->assertEquals($terms, $this->reflect($this->instance)->terms);
    }

    /**
     * Tests whether existing terms are correctly overwritten when new terms are set.
     *
     * @since [*next-version*]
     */
    public function testSetTermsWithExistingTerms()
    {
        $this->reflect($this->instance)->terms = array($this->mockEvaluable());

        $terms = array(
            $this->mockEvaluable(),
            $this->mockEvaluable(),
            $this->mockEvaluable(),
        );

        $this->instance->setTerms($terms);

        $this->assertEquals($terms, $this->reflect($this->instance)->terms);
    }
}
