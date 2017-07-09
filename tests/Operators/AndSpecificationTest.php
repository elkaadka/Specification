<?php

namespace Kanel\Specification\Tests\Operators;

use Kanel\Specification\Operators\AndSpecification;
use Kanel\Specification\SpecificationInterface;
use PHPUnit\Framework\TestCase;

class AndSpecificationTest extends TestCase
{
    /**
     * @dataProvider getData
     * @param $object
     */
    public function testIsSatisfiedBy($object)
    {
        $specification1 = $this->getMockBuilder(SpecificationInterface::class)->getMock();
        $specification1
            ->expects($this->exactly(4))
            ->method('isSatisfiedBy')
            ->with($object)
            ->will($this->onConsecutiveCalls(true, true, false, false))
        ;

        $specification2 = $this->getMockBuilder(SpecificationInterface::class)->getMock();
        $specification2
            ->expects($this->exactly(2)) //2 times because when spec1 is false, spec2 is not called
            ->method('isSatisfiedBy')
            ->with($object)
            ->will($this->onConsecutiveCalls(false, true))
        ;

        $andSpecification = new AndSpecification($specification1, $specification2);

        $this->assertFalse($andSpecification->isSatisfiedBy($object));
        $this->assertTrue($andSpecification->isSatisfiedBy($object));
        $this->assertFalse($andSpecification->isSatisfiedBy($object));
        $this->assertFalse($andSpecification->isSatisfiedBy($object));
    }

    public function getData()
    {
        return [
            [ 'test' ],
            [ [1, 2] ],
            [ 2.8 ],
            [ new class() { } ],
            [ true ],
        ];
    }

}

