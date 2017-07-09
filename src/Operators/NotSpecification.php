<?php

namespace Kanel\Specification\Operators;

use Kanel\Specification\Specification;
use Kanel\Specification\SpecificationInterface;

class NotSpecification extends Specification
{
    protected $specification;

    function __construct(SpecificationInterface $specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy($object): bool
    {
        return !$this->specification->isSatisfiedBy($object);
    }

}