<?php

namespace Dhii\Espresso\Term;

use Dhii\Data\ValueAwareInterface;
use Dhii\Espresso\EvaluationException;
use Dhii\Evaluable\EvaluableInterface;
use Dhii\Expression\CompositeContextInterface;

/**
 * A term whose value can vary depending on the context.
 *
 * @since 0.1
 */
class VariableTerm implements EvaluableInterface
{
    /**
     * The variable identifier.
     *
     * @since 0.1
     *
     * @var string
     */
    protected $identifier;

    /**
     * Constructor.
     *
     * @since 0.1
     *
     * @param string $identifier The variable identifier.
     */
    public function __construct($identifier)
    {
        $this->setIdentifier($identifier);
    }

    /**
     * Gets the identifier.
     *
     * @since 0.1
     *
     * @return string The identifier.
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Sets the identifier.
     *
     * @since 0.1
     *
     * @param string $identifier The new identifier.
     *
     * @return $this This instance.
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     *
     * @throws EvaluationException If no context value
     */
    public function evaluate(ValueAwareInterface $ctx = null)
    {
        $identifier = $this->getIdentifier();

        if ($ctx instanceof CompositeContextInterface && $ctx->hasValue($identifier)) {
            return $ctx->getValueOf($identifier);
        }

        throw new EvaluationException(
            sprintf('No context value given for VariableTerm "%s"', $identifier)
        );
    }

    /**
     * Creates an evaluation exception.
     *
     * @since 0.1
     *
     * @param array $args A variable number of arguments that represent the message and
     *                    interpolation values, similar to the `printf()` family of functions.
     *
     * @return EvaluationException The exception.
     */
    protected function newEvalException(/* array $args... */)
    {
        $msg = call_user_func_array('sprintf', func_get_args());

        return new EvaluationException($msg);
    }
}
