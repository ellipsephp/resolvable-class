<?php

use Ellipse\Resolvable\Classes\ExistingClassReflectionFactory;
use Ellipse\Resolvable\Classes\ClassReflectionFactoryInterface;
use Ellipse\Resolvable\Classes\Exceptions\ClassNotFoundException;

describe('ExistingClassReflectionFactory', function () {

    beforeEach(function () {

        $this->factory = new ExistingClassReflectionFactory;

    });

    it('should implement ClassReflectionFactoryInterface', function () {

        expect($this->factory)->toBeAnInstanceOf(ClassReflectionFactoryInterface::class);

    });

    describe('->__invoke()', function () {

        context('when the given string is an existing class name', function () {

            it('should return a new ReflectionClass', function () {

                $test = ($this->factory)(StdClass::class);

                $reflection = new ReflectionClass(StdClass::class);

                expect($test)->toEqual($reflection);

            });

        });

        context('when the given string is not an existing class name', function () {

            it('should throw a ClassNotFoundException', function () {

                $test = function () {

                    ($this->factory)('test');

                };

                $exception = new ClassNotFoundException('test');

                expect($test)->toThrow($exception);

            });

        });

    });

});
