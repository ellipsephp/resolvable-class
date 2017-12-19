<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Classes\Exceptions;

use RuntimeException;

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;

class ClassIsAbstractException extends RuntimeException implements ResolvingExceptionInterface
{
    public function __construct(string $class)
    {
        $template = "The class '%s' is not instantiable (abstract class)";

        $msg = sprintf($template, $class);

        parent::__construct($msg);
    }
}
