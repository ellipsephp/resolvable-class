<?php

use function Eloquent\Phony\Kahlan\mock;

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;
use Ellipse\Resolvable\Exceptions\ClassResolvingException;
use Ellipse\Resolvable\Exceptions\ParameterResolvingException;

describe('ClassResolvingException', function () {

    it('should implement ResolvingExceptionInterface', function () {

        $delegate = mock(ParameterResolvingException::class)->get();

        $test = new ClassResolvingException('class', $delegate);

        expect($test)->toBeAnInstanceOf(ResolvingExceptionInterface::class);

    });

});
