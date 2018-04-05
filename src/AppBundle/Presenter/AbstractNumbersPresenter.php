<?php

namespace AppBundle\Presenter;

use AppBundle\Calculator\CalculatorInterface;

abstract class AbstractNumbersPresenter
{
    /**
     * @var CalculatorInterface
     */
    protected $calculator;

    /**
     * @param CalculatorInterface $calculator
     */
    public function __construct(CalculatorInterface $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * {@inheritDoc}
     */
    public function getResults(array $numbers): array
    {
        $rows = [];

        $total = sizeof($numbers);

        for ($col = 0, $row = 0; $col < $total - 1, $row < $total; $col++) {
            $rows[$row][$col] = $this->calculator->calculate($numbers, $row, $col);

            if ($col >= $total - 1) {
                $col = -1;
                $row++;
            }
        }

        return $rows;
    }
}
