<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Classes;

use ReflectionClass;

use Ellipse\Resolvable\Classes\Exceptions\ClassNotFoundException;

class ExistingClassReflectionFactory implements ClassReflectionFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(string $class): ReflectionClass
    {
        if (interface_exists($class) || class_exists($class)) {

            return new ReflectionClass($class);

        }

        throw new ClassNotFoundException($class);
    }
}
