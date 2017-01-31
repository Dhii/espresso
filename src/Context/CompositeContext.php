<?php

namespace Dhii\Espresso\Context;

use Dhii\Expression\AbstractCompositeContext;

/**
 * A context that has multiple values.
 *
 * @since [*next-version*]
 */
class CompositeContext extends AbstractCompositeContext
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
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
     * @since [*next-version*]
     */
    public function getValue()
    {
        return $this->_getValue();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getValueOf($key)
    {
        return $this->_getValueOf($key);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function hasValue($key)
    {
        return $this->_hasValue($key);
    }

    /**
     * Sets the values or a single value.
     *
     * @since [*next-version*]
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
     * @since [*next-version*]
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
     * @since [*next-version*]
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
     * @since [*next-version*]
     *
     * @return $this This instance.
     */
    public function clearValues()
    {
        $this->_clearValues();

        return $this;
    }
}
