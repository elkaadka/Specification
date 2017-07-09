<?php

namespace Kanel\Specification\Tests\Operators;

use Kanel\Specification\Operators\OrSpecification;
use Kanel\Specification\SpecificationInterface;
use PHPUnit\Framework\TestCase;

class OrSpecificationTest extends TestCase
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
            ->will($this->onConsecutiveCalls(false, false, true, true))
        ;

        $specification2 = $this->getMockBuilder(SpecificationInterface::class)->getMock();
        $specification2
            ->expects($this->exactly(2)) //2 times because when spec1 is true, spec2 is not called
            ->method('isSatisfiedBy')
            ->with($object)
            ->will($this->onConsecutiveCalls(true, false))
        ;

        $andSpecification = new OrSpecification($specification1, $specification2);

        $this->assertTrue($andSpecification->isSatisfiedBy($object));
        $this->assertFalse($andSpecification->isSatisfiedBy($object));
        $this->assertTrue($andSpecification->isSatisfiedBy($object));
        $this->assertTrue($andSpecification->isSatisfiedBy($object));
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

