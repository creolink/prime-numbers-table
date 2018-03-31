<?php

namespace AppBundle\Calculator;

use AppBundle\Calculator\CalculatorInterface;

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
