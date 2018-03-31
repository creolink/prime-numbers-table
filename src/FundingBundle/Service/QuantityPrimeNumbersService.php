<?php

namespace AppBundle\Service;

use AppBundle\Service\AbstractPrimeNumbersService;

class QuantityPrimeNumbersService extends AbstractPrimeNumbersService
{
    /**
     * {@inheritDoc}
     */
    public function getPrimeNumbers(): array
    {
        $numbers = $this->getFirstPrimeNumber();

        $number = $this->options->getStart();
        $last = $this->options->getLast();

        $total = sizeof($numbers);

        for ($counter = $total; $counter < $this->options->getQuantity(); $counter++) {
            $number = $this->nextPrimeNumber->getNumber($number);

            if (!empty($last) && $number > $last) {
                break;
            }

            $numbers[] = $number;
        }

        return $numbers;
    }
}
