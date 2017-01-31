<?php

namespace Dhii\Espresso\Term;

use Dhii\Data\ValueAwareInterface;
use Dhii\Evaluable\EvaluableInterface;

/**
 * A term with a literal value.
 *
 * @since 0.1
 */
class LiteralTerm implements EvaluableInterface
{
    /**
     * The literal value.
     *
     * @since 0.1
     *
     * @var mixed
     */
    protected $value;

    /**
     * Constructor.
     *
     * @since 0.1
     *
     * @param mixed $value The literal value.
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * Gets the literal value.
     *
     * @since 0.1
     *
     * @return mixed The literal value.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the literal value.
     *
     * @since 0.1
     *
     * @param mixed $value The new literal value.
     *
     * @return LiteralTerm This instance.
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    public function evaluate(ValueAwareInterface $ctx = null)
    {
        return $this->getValue();
    }
}
