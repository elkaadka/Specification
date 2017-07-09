<?php

namespace Kanel\Specification;

use Kanel\Specification\Operators\AndSpecification;
use Kanel\Specification\Operators\NotSpecification;
use Kanel\Specification\Operators\OrSpecification;
use Kanel\Specification\Operators\XorSpecification;

interface SpecificationInterface
{
    public function isSatisfiedBy($object): bool;

    public function and(SpecificationInterface $specification): AndSpecification;

    public function or(SpecificationInterface $specification): OrSpecification;

    public function xor(SpecificationInterface $specification): XorSpecification;

    public function not(SpecificationInterface $specification): NotSpecification;
}