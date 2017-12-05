<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Classes\Exceptions;

use RuntimeException;

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;

class ClassNotFoundException extends RuntimeException implements ResolvingExceptionInterface
{
    public function __construct(string $class)
    {
        $msg = "Class '%s' not found.";

        parent::__construct(sprintf($msg, $class));
    }
}