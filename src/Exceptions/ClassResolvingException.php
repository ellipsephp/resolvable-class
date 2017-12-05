<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Exceptions;

use RuntimeException;

class ClassResolvingException extends RuntimeException implements ResolvingExceptionInterface
{
    public function __construct(string $class, ParameterResolvingException $delegate)
    {
        $msg = "The class '%s' instantiation failed because $%s value can't be resolved:\n-%s";

        parent::__construct(sprintf($msg, $class, $delegate->parameter()->getName(), $delegate->getMessage()));
    }
}
