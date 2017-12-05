<?php

use function Eloquent\Phony\Kahlan\mock;

use Psr\Container\ContainerInterface;

use Ellipse\Resolvable\ResolvableValueInterface;
use Ellipse\Resolvable\ResolvableValue;
use Ellipse\Resolvable\ResolvableClass;
use Ellipse\Resolvable\Exceptions\ClassResolvingException;
use Ellipse\Resolvable\Exceptions\ParameterResolvingException;

describe('ResolvableClass', function () {

    beforeEach(function () {

        $this->delegate = mock(ResolvableValue::class);

        $this->resolvable = new ResolvableClass('class', $this->delegate->get());

    });

    it('should implement ResolvableValueInterface', function () {

        expect($this->resolvable)->toBeAnInstanceOf(ResolvableValueInterface::class);

    });

    describe('->value()', function () {

        beforeEach(function () {

            $this->container = mock(ContainerInterface::class)->get();

            $this->placeholders = ['p1', 'p2'];

        });

        context('when no ParameterResolvingException is thrown', function () {

            it('should proxy the delegate->value() method', function () {

                $instance = new class {};

                $this->delegate->value->with($this->container, $this->placeholders)->returns($instance);

                $test = $this->resolvable->value($this->container, $this->placeholders);

                expect($test)->toEqual($instance);

            });

        });

        context('when a ParameterResolvingException is thrown', function () {

            it('should wrap it inside a ClassResolvingException', function () {

                $exception = mock(ParameterResolvingException::class)->get();

                $this->delegate->value->with($this->container, $this->placeholders)->throws($exception);

                $test = function () {

                     $this->resolvable->value($this->container, $this->placeholders);

                };

                $exception = new ClassResolvingException('class', $exception);

                expect($test)->toThrow($exception);

            });

        });

    });

});
