<?php

namespace FundingBundle\Factory;

use FundingBundle\Service\NextPrimeNumberService;
use FundingBundle\Service\NativeNextPrimeNumberService;
use FundingBundle\Service\AbstractNextPrimeNumberService;
use FundingBundle\Service\PrimeNumberValidationService as PrimeNumberValidation;

class NextPrimeNumberFactory
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
     * @return AbstractNextPrimeNumberService
     */
    public function createNextPrimeNumberService(): AbstractNextPrimeNumberService
    {
        if (function_exists('gmp_nextprime')) {
            return new NativeNextPrimeNumberService();
        }

        return new NextPrimeNumberService(
            $this->primeNumberValidation
        );
    }
}
