<?php

use function Eloquent\Phony\Kahlan\mock;

use Ellipse\Resolvable\Classes\ExistingClassReflectionFactory;
use Ellipse\Resolvable\Classes\ClassReflectionFactoryInterface;
use Ellipse\Resolvable\Classes\Exceptions\ClassNotFoundException;

describe('ExistingClassReflectionFactory', function () {

    beforeEach(function () {

        $this->delegate = mock(ClassReflectionFactoryInterface::class);

        $this->factory = new ExistingClassReflectionFactory($this->delegate->get());

    });

    it('should implement ClassReflectionFactoryInterface', function () {

        expect($this->factory)->toBeAnInstanceOf(ClassReflectionFactoryInterface::class);

    });

    describe('->__invoke()', function () {

        context('when the delegate does not throw a ReflectionException', function () {

            it('should proxy the delegate', function () {

                $reflection = mock(ReflectionClass::class)->get();

                $this->delegate->__invoke->with('class')->returns($reflection);

                $test = ($this->factory)('class');

                expect($test)->toEqual($reflection);

            });

        });

        context('when the delegate throws a ReflectionException', function () {

            it('should throw a ClassNotFoundException', function () {

                $exception = mock(ReflectionException::class)->get();

                $this->delegate->__invoke->with('class')->throws($exception);

                $test = function () {

                    ($this->factory)('class');

                };

                $exception = new ClassNotFoundException('class');

                expect($test)->toThrow($exception);

            });

        });

    });

});
