<?php

namespace Dhii\Espresso\Context;

use Dhii\Expression\AbstractContext;
use Dhii\Expression\ContextInterface;

/**
 * Description of RawContext.
 *
 * @since 0.1
 */
class RawContext extends AbstractContext implements ContextInterface
{
    /**
     * The value.
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
     * @param mixed $value The context value.
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value.
     *
     * @since 0.1
     *
     * @param mixed $value The new value.
     *
     * @return $this This instance.
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
