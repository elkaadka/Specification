<?php

namespace Kanel\Specification\Tests;

use Kanel\Specification\Operators\AndSpecification;
use Kanel\Specification\Operators\NotSpecification;
use Kanel\Specification\Operators\OrSpecification;
use Kanel\Specification\Operators\XorSpecification;
use Kanel\Specification\Specification;
use Kanel\Specification\SpecificationInterface;
use PHPUnit\Framework\TestCase;

class SpecificationTest extends TestCase
{
    public function testAnd()
    {
        $specification1 = $this->getMockForAbstractClass(Specification::class);
        $specification2  = $this->getMockForAbstractClass(SpecificationInterface::class);
        $specification = $specification1->and($specification2);

        $this->assertInstanceOf(AndSpecification::class, $specification);
    }

    public function testOr()
    {
        $specification1 = $this->getMockForAbstractClass(Specification::class);
        $specification2  = $this->getMockForAbstractClass(SpecificationInterface::class);
        $specification = $specification1->or($specification2);

        $this->assertInstanceOf(OrSpecification::class, $specification);
    }

    public function testXor()
    {
        $specification1 = $this->getMockForAbstractClass(Specification::class);
        $specification2  = $this->getMockForAbstractClass(SpecificationInterface::class);
        $specification = $specification1->xor($specification2);

        $this->assertInstanceOf(XorSpecification::class, $specification);
    }

    public function testNot()
    {
        $specification1 = $this->getMockForAbstractClass(Specification::class);
        $specification2  = $this->getMockForAbstractClass(SpecificationInterface::class);
        $specification = $specification1->not($specification2);

        $this->assertInstanceOf(NotSpecification::class, $specification);
    }

    /**
     * @dataProvider getData
     * @param $data
     */
    public function testComposition($data)
    {
        $trueSpecification = $this->getMockForAbstractClass(Specification::class);
        $trueSpecification->expects($this->any())->method('isSatisfiedBy')->with($data)->willReturn(true);

        $falseSpecification = $this->getMockForAbstractClass(Specification::class);
        $falseSpecification->expects($this->any())->method('isSatisfiedBy')->with($data)->willReturn(false);

        $specification = $trueSpecification->and($falseSpecification);
        $this->assertFalse($specification->isSatisfiedBy($data));

        $specification = $falseSpecification->and($trueSpecification);
        $this->assertFalse($specification->isSatisfiedBy($data));

        $specification = $falseSpecification->and($trueSpecification)->or($trueSpecification);
        $this->assertTrue($specification->isSatisfiedBy($data));

        $specification = $falseSpecification->and($trueSpecification)->or($falseSpecification);
        $this->assertFalse($specification->isSatisfiedBy($data));

        $specification = $trueSpecification->and($trueSpecification)->or($trueSpecification)->not($trueSpecification);
        $this->assertFalse($specification->isSatisfiedBy($data));

        $specification = $falseSpecification->and($trueSpecification)->or($trueSpecification)->not($falseSpecification);
        $this->assertFalse($specification->isSatisfiedBy($data));

        $specification = $falseSpecification->and($trueSpecification)->or($trueSpecification)->xor($falseSpecification);
        $this->assertTrue($specification->isSatisfiedBy($data));
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
