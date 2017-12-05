<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Classes;

use ReflectionClass;

use Ellipse\Resolvable\Classes\Exceptions\ClassNotInstantiableException;

class InstantiableClassReflectionFactory implements ClassReflectionFactoryInterface
{
    /**
     * The delegate.
     *
     * @var \Ellipse\Resolvable\Classes\ClassReflectionFactoryInterface
     */
    private $delegate;

    /**
     * Set up an instantiable class resflection factory with the given delegate.
     *
     * @param \Ellipse\Resolvable\Classes\ClassReflectionFactoryInterface $delegate
     */
    public function __construct(ClassReflectionFactoryInterface $delegate)
    {
        $this->delegate = $delegate;
    }

    /**
     * @inheritdoc
     */
    public function __invoke(string $class): ReflectionClass
    {
        $reflection = ($this->delegate)($class);

        if ($reflection->isInstantiable()) {

            return $reflection;

        }

        throw new ClassNotInstantiableException($class);
    }
}
