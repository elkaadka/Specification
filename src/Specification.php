<?php declare(strict_types=1);

namespace Kanel\Specification;

use Kanel\Specification\Operators\AndSpecification;
use Kanel\Specification\Operators\NotSpecification;
use Kanel\Specification\Operators\OrSpecification;
use Kanel\Specification\Operators\XorSpecification;

abstract class Specification implements SpecificationInterface
{
    final public function and(SpecificationInterface $specification): AndSpecification
    {
        return new AndSpecification($this, $specification);
    }

    final public function or(SpecificationInterface $specification): OrSpecification
    {
        return new OrSpecification($this, $specification);
    }

    final public function xor(SpecificationInterface $specification): XorSpecification
    {
        return new XorSpecification($this, $specification);
    }

    final public function not(SpecificationInterface $specification): NotSpecification
    {
        return new NotSpecification($this);
    }
}