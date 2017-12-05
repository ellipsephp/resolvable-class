<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Classes\Exceptions;

use RuntimeException;

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;

class ClassNotInstantiableException extends RuntimeException implements ResolvingExceptionInterface
{
    public function __construct(string $class)
    {
        $msg = "The class '%s' is not instantiable (interface or abstract).";

        parent::__construct(sprintf($msg, $class));
    }
}
