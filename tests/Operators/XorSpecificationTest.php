<?php

namespace Kanel\Specification\Tests\Operators;

use Kanel\Specification\Operators\XorSpecification;
use Kanel\Specification\SpecificationInterface;
use PHPUnit\Framework\TestCase;

class XorSpecificationTest extends TestCase
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
            ->expects($this->exactly(4)) //2 times because when spec1 is false, spec2 is not called
            ->method('isSatisfiedBy')
            ->with($object)
            ->will($this->onConsecutiveCalls(true, false, true, false))
        ;

        $andSpecification = new XorSpecification($specification1, $specification2);

        $this->assertFalse($andSpecification->isSatisfiedBy($object));
        $this->assertTrue($andSpecification->isSatisfiedBy($object));
        $this->assertTrue($andSpecification->isSatisfiedBy($object));
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

