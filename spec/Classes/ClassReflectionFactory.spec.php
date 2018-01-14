<?php

use Ellipse\Resolvable\Classes\ClassReflectionFactory;
use Ellipse\Resolvable\Classes\ClassReflectionFactoryInterface;

describe('ClassReflectionFactory', function () {

    beforeEach(function () {

        $this->factory = new ClassReflectionFactory;

    });

    it('should implement ClassReflectionFactoryInterface', function () {

        expect($this->factory)->toBeAnInstanceOf(ClassReflectionFactoryInterface::class);

    });

    describe('->__invoke()', function () {

        it('should return a new ReflectionClass from the given class name', function () {

            $test = ($this->factory)(StdClass::class);

            $reflection = new ReflectionClass(StdClass::class);

            expect($test)->toEqual($reflection);

        });

    });

});
