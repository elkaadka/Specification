<?php

namespace Kanel\Specification\Operators;

use Kanel\Specification\Specification;
use Kanel\Specification\SpecificationInterface;

class AndSpecification extends Specification
{
    protected $specification1;
    protected $specification2;

    public function __construct(SpecificationInterface $specification1, SpecificationInterface $specification2)
    {
        $this->specification1 = $specification1;
        $this->specification2 = $specification2;
    }

    public function isSatisfiedBy($object): bool
    {
        return $this->specification1->isSatisfiedBy($object) && $this->specification2->isSatisfiedBy($object);
    }

}

