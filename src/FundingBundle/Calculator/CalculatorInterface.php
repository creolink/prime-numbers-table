<?php

namespace FundingBundle\Calculator;

interface CalculatorInterface
{
    /**
     * @param array $values
     * @param int $row
     * @param int $column
     * @return int|float
     */
    public function calculate(array $values, int $row, int $column);
}
