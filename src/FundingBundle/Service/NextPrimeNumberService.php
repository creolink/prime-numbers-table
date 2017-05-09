<?php

namespace FundingBundle\Service;

use FundingBundle\Service\AbstractNextPrimeNumberService;
use FundingBundle\Service\PrimeNumberValidationService as PrimeNumberValidation;

class NextPrimeNumberService extends AbstractNextPrimeNumberService
{
    /**
     * @var PrimeNumberValidation
     */
    private $primeNumberValidation;

    /**
     * @param PrimeNumberValidation $primeNumberValidation
     */
    public function __construct(PrimeNumberValidation $primeNumberValidation)
    {
        $this->primeNumberValidation = $primeNumberValidation;
    }

    /**
     * {@inheritDoc}
     */
    public function getNumber(int $number): int
    {
        $number = $number < 0 ? 0 : $number;

        do {
            $number++;
        } while (false === $this->primeNumberValidation->isPrime($number));

        return $number;
    }
}
