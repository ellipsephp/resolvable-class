<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Classes\Exceptions;

use RuntimeException;

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;

class InterfaceNameException extends RuntimeException implements ResolvingExceptionInterface
{
    public function __construct(string $class)
    {
        $template = "The name '%s' is an interface name";

        $msg = sprintf($template, $class);

        parent::__construct($msg);
    }
}
