<?php declare(strict_types=1);

namespace Ellipse\Resolvable;

use Psr\Container\ContainerInterface;

use Ellipse\Resolvable\Exceptions\ParameterResolvingException;
use Ellipse\Resolvable\Exceptions\ClassResolvingException;

class ResolvableClass implements ResolvableValueInterface
{
    /**
     * The class name.
     *
     * @var string
     */
    private $class;

    /**
     * The delegate.
     *
     * @var \Ellipse\Resolvable\ResolvableValue
     */
    private $delegate;

    /**
     * Set up a resolvable class with the given class name and resolvable
     * value.
     *
     * @param string                                $class
     * @param \Ellipse\Resolvable\ResolvableValue   $delegate
     */
    public function __construct(string $class, ResolvableValue $delegate)
    {
        $this->class = $class;
        $this->delegate = $delegate;
    }

    /**
     * @inheritdoc
     */
    public function value(ContainerInterface $container, array $placeholders = [])
    {
        try {

            return $this->delegate->value($container, $placeholders);

        }

        catch (ParameterResolvingException $e) {

            throw new ClassResolvingException($this->class, $e);

        }
    }
}
