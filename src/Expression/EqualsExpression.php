<?php

namespace Dhii\Espresso\Expression;

use Dhii\Data\ValueAwareInterface;
use Dhii\Espresso\AbstractGenericExpression;
use Dhii\Evaluable\EvaluableInterface;
use Dhii\Expression\ExpressionInterface;

/**
 * Represents an equivalence expression.
 *
 * @since [*next-version*]
 */
class EqualsExpression extends AbstractGenericExpression implements ExpressionInterface
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param EvaluableInterface[] $terms An array of terms or a variable number of arguments.
     */
    public function __construct($terms = array() /*, ... */)
    {
        $actualTerms = is_array($terms)
            ? $terms
            : func_get_args();

        $this->_setTerms($actualTerms);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function evaluate(ValueAwareInterface $ctx = null)
    {
        $terms = $this->getTerms();
        $count = count($terms);

        if ($count < 2) {
            return false;
        }

        $value = $terms[0]->evaluate($ctx);

        for ($i = 1; $i < $count; ++$i) {
            if ($terms[$i]->evaluate($ctx) !== $value) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getTerms()
    {
        return $this->_getTerms();
    }
}
