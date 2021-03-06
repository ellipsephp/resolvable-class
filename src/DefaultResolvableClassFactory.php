<?php declare(strict_types=1);

namespace Ellipse\Resolvable;

use Ellipse\Resolvable\Classes\ClassReflectionFactory;
use Ellipse\Resolvable\Classes\ExistingClassReflectionFactory;
use Ellipse\Resolvable\Classes\NotInterfaceReflectionFactory;
use Ellipse\Resolvable\Classes\NotAbstractClassReflectionFactory;

class DefaultResolvableClassFactory extends ResolvableClassFactory
{
    /**
     * Set up a resolvable class factory with a default reflection factory.
     */
    public function __construct()
    {
        parent::__construct(new NotAbstractClassReflectionFactory(
            new NotInterfaceReflectionFactory(
                new ExistingClassReflectionFactory(
                    new ClassReflectionFactory
                )
            )
        ));
    }
}
