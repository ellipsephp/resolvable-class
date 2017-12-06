<?php

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;
use Ellipse\Resolvable\Classes\Exceptions\ClassIsAbstractException;

describe('ClassIsAbstractException', function () {

    it('should implement ResolvingExceptionInterface', function () {

        $test = new ClassIsAbstractException('class');

        expect($test)->toBeAnInstanceOf(ResolvingExceptionInterface::class);

    });

});
