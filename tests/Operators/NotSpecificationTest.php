<?php

namespace Kanel\Specification\Tests\Operators;

use Kanel\Specification\Operators\NotSpecification;
use Kanel\Specification\SpecificationInterface;
use PHPUnit\Framework\TestCase;

class NotSpecificationTest extends TestCase
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

        $andSpecification = new NotSpecification($specification1);

        $this->assertTrue($andSpecification->isSatisfiedBy($object));
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

