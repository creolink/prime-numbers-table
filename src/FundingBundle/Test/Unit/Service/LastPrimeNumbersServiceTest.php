<?php

namespace FundingBundle\Test\Unit\Service;

use FundingBundle\Service\LastPrimeNumbersService;
use FundingBundle\Test\Unit\Service\AbstractTestCase;
use FundingBundle\Entity\CommandOptionsInterface;

class LastPrimeNumbersServiceTest extends AbstractTestCase
{
    /**
     * @test
     */
    public function testLastPrimeNumbersShouldBeEmptyForNotSetLastParameter()
    {
        $options = $this->createPMCommandOption();

        $this->assertEmpty(
            $this->getLastPrimeNumbersService($options)
                ->getPrimeNumbers()
        );
    }

    /**
     * @test
     */
    public function testLastPrimeNumbersForSetLastParameterAndDefaultStartParameter()
    {
        $options = $this->createPMCommandOption();
        $options->setLast(10);

        $this->assertEquals(
            [2, 3, 5, 7],
            $this->getLastPrimeNumbersService($options)
                ->getPrimeNumbers()
        );
    }

    /**
     * @test
     */
    public function testLastPrimeNumbersForSetLastParameterAndNotDefaultStartParameter()
    {
        $options = $this->createPMCommandOption();
        $options->setLast(20);
        $options->setStart(5);

        $this->assertEquals(
            [5, 7, 11, 13, 17, 19],
            $this->getLastPrimeNumbersService($options)
                ->getPrimeNumbers()
        );
    }

    /**
     * @test
     */
    public function testLastPrimeNumbersForNegativeLastParameter()
    {
        $options = $this->createPMCommandOption();
        $options->setLast(-20);

        $this->assertEmpty(
            $this->getLastPrimeNumbersService($options)
                ->getPrimeNumbers()
        );
    }

    /**
     * @test
     */
    public function testLastPrimeNumbersForNegativeStartParameter()
    {
        $options = $this->createPMCommandOption();
        $options->setStart(-20);
        $options->setLast(10);

        $this->assertEquals(
            [2, 3, 5, 7],
            $this->getLastPrimeNumbersService($options)
                ->getPrimeNumbers()
        );
    }

    /**
     * @param CommandOptionsInterface $options
     * @return LastPrimeNumbersService
     */
    private function getLastPrimeNumbersService(CommandOptionsInterface $options): LastPrimeNumbersService
    {
        $lastPrimeNumbersService = new LastPrimeNumbersService(
            $this->getNextPrimeNumberService(),
            $this->getPrimeNumberValidationService()
        );

        $lastPrimeNumbersService->setOptions($options);

        return $lastPrimeNumbersService;
    }
}
