<?php

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;
use Ellipse\Resolvable\Classes\Exceptions\ClassNotFoundException;

describe('ClassNotFoundException', function () {

    it('should implement ResolvingExceptionInterface', function () {

        $test = new ClassNotFoundException('class');

        expect($test)->toBeAnInstanceOf(ResolvingExceptionInterface::class);

    });

});
