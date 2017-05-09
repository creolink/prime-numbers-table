<?php

namespace FundingBundle\Service;

use FundingBundle\Service\AbstractNextPrimeNumberService;

class NativeNextPrimeNumberService extends AbstractNextPrimeNumberService
{
    /**
     * {@inheritDoc}
     */
    public function getNumber(int $number): int
    {
        return gmp_strval(
            gmp_nextprime($number)
        );
    }
}
