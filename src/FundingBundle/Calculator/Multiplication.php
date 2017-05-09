<?php

namespace FundingBundle\Calculator;

use FundingBundle\Calculator\CalculatorInterface;

class Multiplication implements CalculatorInterface
{
    /**
     * {@inheritDoc}
     */
    public function calculate(array $values, int $row, int $column)
    {
        return $values[$row] * $values[$column];
    }
}
