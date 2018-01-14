<?php declare(strict_types=1);

namespace Ellipse\Resolvable;

use Ellipse\Resolvable\Classes\ClassReflectionFactoryInterface;

abstract class AbstractResolvableClassFactory implements ResolvableClassFactoryInterface
{
    /**
     * The reflection factory.
     *
     * @var \Ellipse\Resolvable\Classes\ClassReflectionFactoryInterface
     */
    private $reflection;

    /**
     * Set up a resolvable class factory with the given reflection factory.
     *
     * @param \Ellipse\Resolvable\Classes\ClassReflectionFactoryInterface $reflection
     */
    public function __construct(ClassReflectionFactoryInterface $reflection)
    {
        $this->reflection = $reflection;
    }

    /**
     * Return a new ResolvableValue from the given class name.
     *
     * @param string $class
     * @return \Ellipse\Resolvable\ResolvableClass
     */
    public function __invoke(string $class): ResolvableClass
    {
        $reflection = ($this->reflection)($class);

        $constructor = $reflection->getConstructor();

        $factory = [$reflection, 'newInstance'];

        $parameters = is_null($constructor) ? [] : $constructor->getParameters();

        return new ResolvableClass(
            $class,
            new ResolvableValue($factory, $parameters)
        );
    }
}
