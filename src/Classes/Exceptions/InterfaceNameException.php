<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Classes\Exceptions;

use RuntimeException;

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;

class InterfaceNameException extends RuntimeException implements ResolvingExceptionInterface
{
    public function __construct(string $class)
    {
        $msg = "The string '%s' is an interface name.";

        parent::__construct(sprintf($msg, $class));
    }
}
