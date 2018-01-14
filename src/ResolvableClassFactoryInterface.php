<?php declare(strict_types=1);

namespace Ellipse\Resolvable;

interface ResolvableClassFactoryInterface
{
    /**
     * Return a new ResolvableClass from the given class name.
     *
     * @param string $class
     * @return \Ellipse\Resolvable\ResolvableClass
     */
    public function __invoke(string $class): ResolvableClass;
}
