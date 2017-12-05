<?php

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;
use Ellipse\Resolvable\Classes\Exceptions\ClassNotInstantiableException;

describe('ClassNotInstantiableException', function () {

    it('should implement ResolvingExceptionInterface', function () {

        $test = new ClassNotInstantiableException('class');

        expect($test)->toBeAnInstanceOf(ResolvingExceptionInterface::class);

    });

});
