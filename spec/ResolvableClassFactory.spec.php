<?php

use function Eloquent\Phony\Kahlan\mock;

use Psr\Container\ContainerInterface;

use Ellipse\Resolvable\ResolvableClass;
use Ellipse\Resolvable\ResolvableClassFactory;
use Ellipse\Resolvable\AbstractResolvableClassFactory;
use Ellipse\Resolvable\Classes\Exceptions\InterfaceNameException;
use Ellipse\Resolvable\Classes\Exceptions\ClassIsAbstractException;
use Ellipse\Resolvable\Classes\Exceptions\ClassNotFoundException;

describe('ResolvableClassFactory', function () {

    beforeAll(function () {

        // The interface has a method because php reflection ->isAbstract() return
        // true for interfaces with methods!

        interface TestInterface { public function test(); }
        abstract class AbstractTest {}

    });

    beforeEach(function () {

        $this->factory = new ResolvableClassFactory;

    });

    it('should extend AbstractResolvableClassFactory', function () {

        expect($this->factory)->toBeAnInstanceOf(AbstractResolvableClassFactory::class);

    });

    describe('->__invoke()', function () {

        context('when the given string is an existing class name', function () {

            it('should return a ResolvableClass', function () {

                $test = ($this->factory)(StdClass::class);

                expect($test)->toBeAnInstanceOf(ResolvableClass::class);

            });

        });

        context('when the given string is an interface name', function () {

            it('should throw a InterfaceNameException', function () {

                $test = function () {

                    ($this->factory)(TestInterface::class);

                };

                $exception = new InterfaceNameException(TestInterface::class);

                expect($test)->toThrow($exception);

            });

        });

        context('when the given string is an abstract class name', function () {

            it('should throw a ClassIsAbstractException', function () {

                $test = function () {

                    ($this->factory)(AbstractTest::class);

                };

                $exception = new ClassIsAbstractException(AbstractTest::class);

                expect($test)->toThrow($exception);

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
