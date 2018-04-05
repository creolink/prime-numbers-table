<?php

namespace AppBundle\Test;

use AppBundle\Entity\PMCommandOption;
use AppBundle\Entity\CommandOptionsInterface;
use AppBundle\Service\PrimeNumberValidationService;
use AppBundle\Factory\NextPrimeNumberFactory;
use AppBundle\Service\AbstractNextPrimeNumberService;

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
