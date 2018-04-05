<?php

namespace AppBundle\Test\Unit\Service;

use AppBundle\Service\QuantityPrimeNumbersService;
use AppBundle\Service\AbstractNextPrimeNumberService;
use AppBundle\Entity\CommandOptionsInterface;
use \Mockery as m;

class QuantityPrimeNumbersServiceTest extends AbstractTestCase
{
    /**
     * @var array
     */
    private $primeNumbers = [
        0 => 2,
        1 => 2,
        2 => 3,
        3 => 5,
        4 => 5,
        5 => 7,
        6 => 7,
        7 => 11,
        8 => 11,
        9 => 11,
        10 => 11,
        11 => 13,
    ];

    /**
     * @test
     */
    public function testQuantityPrimeNumbersShouldBeEmptyForDefaultValues()
    {
        $options = $this->createPMCommandOption();

        $this->assertEmpty(
            $this->getQuantityPrimeNumbersService($options)
                ->getPrimeNumbers()
        );
    }

    /**
     * @test
     */
    public function testQuantityPrimeNumbersForSetQuantityParameterAndDefaultStartParameter()
    {
        $options = $this->createPMCommandOption();
        $options->setQuantity(5);

        $this->assertEquals(
            [2, 3, 5, 7, 11],
            $this->getQuantityPrimeNumbersService($options)
                ->getPrimeNumbers()
        );
    }

    /**
     * @param CommandOptionsInterface $options
     * @return QuantityPrimeNumbersService
     */
    private function getQuantityPrimeNumbersService(CommandOptionsInterface $options): QuantityPrimeNumbersService
    {
        $quantityPrimeNumbersService = new QuantityPrimeNumbersService(
            $this->mockNextPrimeNumberService(),
            $this->getPrimeNumberValidationService()
        );

        $quantityPrimeNumbersService->setOptions($options);

        return $quantityPrimeNumbersService;
    }

    /**
     * @return AbstractNextPrimeNumberService
     */
    private function mockNextPrimeNumberService(): AbstractNextPrimeNumberService
    {
        $mock = m::mock('AppBundle\Service\AbstractNextPrimeNumberService');

        foreach ($this->primeNumbers as $number => $result) {
            $mock->shouldReceive('getNumber')
                ->with($number)
                ->andReturn($result);
        }

        return $mock;
    }
}
