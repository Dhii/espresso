<?php

namespace Dhii\Espresso\Context;

use Dhii\Expression\AbstractCompositeContext;
use Dhii\Expression\CompositeContextInterface;

/**
 * A context that has multiple values.
 *
 * @since 0.1
 */
class CompositeContext extends AbstractCompositeContext implements CompositeContextInterface
{
    /**
     * Constructor.
     *
     * @since 0.1
     *
     * @param array $values The context values.
     */
    public function __construct(array $values = array())
    {
        $this->_setValues($values);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    public function getValue()
    {
        return $this->_getValue();
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    public function getValueOf($key)
    {
        return $this->_getValueOf($key);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    public function hasValue($key)
    {
        return $this->_hasValue($key);
    }

    /**
     * Sets the values or a single value.
     *
     * @since 0.1
     *
     * @param string $key   The key of the value to set.
     * @param mixed  $value [optional] The value to set. Default: null
     *
     * @return $this This instance.
     */
    public function setValue($key, $value = null)
    {
        $this->_setValue($key, $value);

        return $this;
    }

    /**
     * Sets all of the context values, overwriting existing ones.
     *
     * @since 0.1
     *
     * @param array $values An associative array of values.
     *
     * @return $this This instance.
     */
    public function setValues(array $values)
    {
        $this->_setValues($values);

        return $this;
    }

    /**
     * Removes a value.
     *
     * @since 0.1
     *
     * @param string $key The key of the value to remove.
     *
     * @return $this This instance.
     */
    public function removeValue($key)
    {
        $this->_removeValue($key);

        return $this;
    }

    /**
     * Removes all the values from the context.
     *
     * @since 0.1
     *
     * @return $this This instance.
     */
    public function clearValues()
    {
        $this->_clearValues();

        return $this;
    }
}
