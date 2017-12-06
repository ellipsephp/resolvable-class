<?php

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;
use Ellipse\Resolvable\Classes\Exceptions\InterfaceNameException;

describe('InterfaceNameException', function () {

    it('should implement ResolvingExceptionInterface', function () {

        $test = new InterfaceNameException('class');

        expect($test)->toBeAnInstanceOf(ResolvingExceptionInterface::class);

    });

});
