<?php

namespace Kanel\Specification\Operators;

use Kanel\Specification\Specification;
use Kanel\Specification\SpecificationInterface;

class XorSpecification extends Specification
{
    protected $specification1;
    protected $specification2;

    function __construct(SpecificationInterface $specification1, SpecificationInterface $specification2)
    {
        $this->specification1 = $specification1;
        $this->specification2 = $specification2;
    }

    public function isSatisfiedBy($object): bool
    {
        return ($this->specification1->isSatisfiedBy($object) xor  $this->specification2->isSatisfiedBy($object));
    }

}