<?php

use function Eloquent\Phony\Kahlan\mock;

use Ellipse\Resolvable\Classes\NotAbstractClassReflectionFactory;
use Ellipse\Resolvable\Classes\ClassReflectionFactoryInterface;
use Ellipse\Resolvable\Classes\Exceptions\ClassIsAbstractException;

describe('NotAbstractClassReflectionFactory', function () {

    beforeEach(function () {

        $this->delegate = mock(ClassReflectionFactoryInterface::class);

        $this->factory = new NotAbstractClassReflectionFactory($this->delegate->get());

    });

    it('should implement ClassReflectionFactoryInterface', function () {

        expect($this->factory)->toBeAnInstanceOf(ClassReflectionFactoryInterface::class);

    });

    describe('->__invoke()', function () {

        beforeEach(function () {

            $this->reflection = mock(ReflectionClass::class);

            $this->delegate->__invoke->with('class')->returns($this->reflection);

        });

        context('when the ->isAbstract() method of the reflection class produced by the delegate returns false', function () {

            it('should proxy the delegate ->__invoke() method', function () {

                $this->reflection->isAbstract->returns(false);

                $test = ($this->factory)('class');

                expect($test)->toBe($this->reflection->get());

            });

        });

        context('when the ->isAbstract() method of the reflection class produced by the delegate returns true', function () {

            it('should throw a ClassIsAbstractException', function () {

                $this->reflection->isAbstract->returns(true);

                $test = function () {

                    ($this->factory)('class');

                };

                $exception = new ClassIsAbstractException('class');

                expect($test)->toThrow($exception);

            });

        });

    });

});
