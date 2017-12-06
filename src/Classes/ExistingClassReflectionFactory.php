<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Classes;

use ReflectionClass;
use ReflectionException;

use Ellipse\Resolvable\Classes\Exceptions\ClassNotFoundException;

class ExistingClassReflectionFactory implements ClassReflectionFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(string $class): ReflectionClass
    {
        try {

            return new ReflectionClass($class);

        }

        catch (ReflectionException $e) {

            throw new ClassNotFoundException($class);

        }
    }
}
