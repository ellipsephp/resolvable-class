<?php declare(strict_types=1);

namespace Ellipse\Resolvable;

use Ellipse\Resolvable\Classes\InstantiableClassReflectionFactory;
use Ellipse\Resolvable\Classes\ExistingClassReflectionFactory;

class ResolvableClassFactory
{
    /**
     * The delegate.
     *
     * @var \Ellipse\Resolvable\Classes\ClassReflectionFactoryInterface
     */
    private $delegate;

    /**
     * Set up a resolvable class factory.
     */
    public function __construct()
    {
        $this->delegate = new InstantiableClassReflectionFactory(
            new ExistingClassReflectionFactory
        );
    }

    /**
     * Return a new ResolvableValue from the given class name.
     *
     * @param string $class
     * @return \Ellipse\Resolvable\ResolvableClass
     */
    public function __invoke(string $class): ResolvableClass
    {
        $reflection = ($this->delegate)($class);

        $constructor = $reflection->getConstructor();

        $factory = [$reflection, 'newInstance'];

        $parameters = is_null($constructor) ? [] : $constructor->getParameters();

        return new ResolvableClass(
            $class,
            new ResolvableValue($factory, $parameters)
        );
    }
}
