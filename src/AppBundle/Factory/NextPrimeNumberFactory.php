<?php

namespace AppBundle\Factory;

use AppBundle\Service\NextPrimeNumberService;
use AppBundle\Service\NativeNextPrimeNumberService;
use AppBundle\Service\AbstractNextPrimeNumberService;
use AppBundle\Service\PrimeNumberValidationService as PrimeNumberValidation;

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
