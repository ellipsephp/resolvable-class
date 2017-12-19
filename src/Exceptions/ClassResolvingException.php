<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Exceptions;

use RuntimeException;

class ClassResolvingException extends RuntimeException implements ResolvingExceptionInterface
{
    public function __construct(string $class, ParameterResolvingException $previous)
    {
        $template = "The instantiation of class '%s' failed";

        $msg = sprintf($template, $class);

        parent::__construct($msg, 0, $previous);
    }
}
