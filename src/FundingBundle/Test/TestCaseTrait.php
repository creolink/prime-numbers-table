<?php

namespace FundingBundle\Test;

use FundingBundle\Entity\PMCommandOption;
use FundingBundle\Entity\CommandOptionsInterface;
use FundingBundle\Service\PrimeNumberValidationService;
use FundingBundle\Factory\NextPrimeNumberFactory;
use FundingBundle\Service\AbstractNextPrimeNumberService;

trait TestCaseTrait
{
    /**
     * @return CommandOptionsInterface
     */
    protected function createPMCommandOption(): CommandOptionsInterface
    {
        return new PMCommandOption();
    }

    /**
     * @return PrimeNumberValidationService
     */
    protected function getPrimeNumberValidationService(): PrimeNumberValidationService
    {
        return new PrimeNumberValidationService();
    }

    /**
     * @return AbstractNextPrimeNumberService
     */
    protected function getNextPrimeNumberService(): AbstractNextPrimeNumberService
    {
        $nextPrimeNumberFactory = new NextPrimeNumberFactory(
            $this->getPrimeNumberValidationService()
        );

        return $nextPrimeNumberFactory->createNextPrimeNumberService();
    }
}
