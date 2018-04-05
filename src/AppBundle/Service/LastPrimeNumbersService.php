<?php

namespace AppBundle\Service;

use AppBundle\Service\AbstractPrimeNumbersService;

class LastPrimeNumbersService extends AbstractPrimeNumbersService
{
    /**
     * {@inheritDoc}
     */
    public function getPrimeNumbers(): array
    {
        $numbers = $this->getFirstPrimeNumber();

        $number = $this->options->getStart();
        $quantity = $this->options->getQuantity();

        while (($number = $this->nextPrimeNumber->getNumber($number)) <= $this->options->getLast()) {
            if ($quantity > 0 && count($numbers) >= $quantity) {
                break;
            }

            $numbers[] = $number;
        }

        return $numbers;
    }
}
