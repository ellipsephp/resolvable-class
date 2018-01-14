<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Classes;

use ReflectionClass;

class ClassReflectionFactory implements ClassReflectionFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(string $class): ReflectionClass
    {
        return new ReflectionClass($class);
    }
}
