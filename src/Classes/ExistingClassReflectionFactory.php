<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Classes;

use ReflectionClass;
use ReflectionException;

use Ellipse\Resolvable\Classes\Exceptions\ClassNotFoundException;

class ExistingClassReflectionFactory implements ClassReflectionFactoryInterface
{
    /**
     * The delegate.
     *
     * @var \Ellipse\Resolvable\Classes\ClassReflectionFactoryInterface
     */
    private $delegate;

    /**
     * Set up an existing class resflection factory with the given delegate.
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
        try {

            return ($this->delegate)($class);

        }

        catch (ReflectionException $e) {

            throw new ClassNotFoundException($class);

        }
    }
}
