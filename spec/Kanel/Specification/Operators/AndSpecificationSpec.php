<?php

namespace spec\Kanel\Specification\Operators;

use Kanel\Specification\SpecificationInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AndSpecificationSpec extends ObjectBehavior
{
    /**
     * Cannot perform spec tests on this project because of this issue : https://github.com/phpspec/prophecy/pull/344
     * @param SpecificationInterface $specification1
     * @param SpecificationInterface $specification2
     */
    public function it_should_return_false_if_one_parameter_returns_false(SpecificationInterface $specification1, SpecificationInterface $specification2)
    {
        /*$object = 'test';
        $this->beConstructedWith($specification1, $specification2);
        $specification1->isSatisfiedBy($object)->willReturn(false);
        $specification2->isSatisfiedBy($object)->willReturn(true);

        $this->isSatisfiedBy($object)->shouldReturn(false);*/
    }
}
