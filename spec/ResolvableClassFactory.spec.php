<?php

use function Eloquent\Phony\Kahlan\mock;

use Psr\Container\ContainerInterface;

use Ellipse\Resolvable\ResolvableValue;
use Ellipse\Resolvable\ResolvableClass;
use Ellipse\Resolvable\ResolvableClassFactory;
use Ellipse\Resolvable\Classes\NotAbstractClassReflectionFactory;
use Ellipse\Resolvable\Classes\Exceptions\InterfaceNameException;

describe('ResolvableClassFactory', function () {

    beforeEach(function () {

        $this->delegate = mock(NotAbstractClassReflectionFactory::class);

        allow(NotAbstractClassReflectionFactory::class)->toBe($this->delegate->get());

        $this->factory = new ResolvableClassFactory;

    });

    describe('->__invoke()', function () {

        beforeEach(function () {

            $this->reflection = mock(ReflectionClass::class);

            $this->delegate->__invoke->returns($this->reflection);

            $this->class = [$this->reflection->get(), 'newInstance'];

        });

        context('when the class has a constructor', function () {

            it('should get an array of ReflectionParameter using the reflection class constructor ->getParameters() method', function () {

                $constructor = mock(ReflectionMethod::class);
                $parameters = [
                    mock(ReflectionParameter::class)->get(),
                    mock(ReflectionParameter::class)->get(),
                ];

                $this->reflection->getConstructor->returns($constructor);

                $constructor->getParameters->returns($parameters);

                $test = ($this->factory)('class');

                $resolvable = new ResolvableClass(
                    'class',
                    new ResolvableValue($this->class, $parameters)
                );

                expect($test)->toEqual($resolvable);

            });

        });

        context('when the class dont have a constructor', function () {

            it('should use an empty array of ReflectionParameter', function () {

                $this->reflection->getConstructor->returns(null);

                $test = ($this->factory)('class');

                $resolvable = new ResolvableClass(
                    'class',
                    new ResolvableValue($this->class, [])
                );

                expect($test)->toEqual($resolvable);

            });

        });

    });

});

describe('ResolvableClassFactory', function () {

    beforeAll(function () {

        class TestClass
        {
            public $parameters;

            public function __construct(TestClass2 $p1, int $p2 = 0, int $p3, int $p4 = 4)
            {
                $this->parameters = [$p1, $p2, $p3, $p4];
            }
        }

        class TestClass2 {}

        interface TestInterface {

            public function test();

        }

    });

    describe('->__invoke()->value()', function () {

        beforeEach(function () {

            $this->container = mock(ContainerInterface::class);

        });

        it('should execute the given callable', function () {

            $instance = new TestClass2;

            $placeholders = [2, 3];

            $this->container->get->with(TestClass2::class)->returns($instance);

            $factory = new ResolvableClassFactory;

            $test = $factory(TestClass::class)->value($this->container->get(), $placeholders);

            expect($test->parameters[0])->toBe($instance);
            expect($test->parameters[1])->toEqual(2);
            expect($test->parameters[2])->toEqual(3);
            expect($test->parameters[3])->toEqual(4);

        });

        it('should throw InterfaceNameException before ClassIsAbstractException', function () {

            $factory = new ResolvableClassFactory;

            $test = function () use ($factory) {

                $factory(TestInterface::class)->value($this->container->get(), []);

            };

            $exception = mock(InterfaceNameException::class)->get();

            expect($test)->toThrow();

        });

    });

});
