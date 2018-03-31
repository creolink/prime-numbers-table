<?php

namespace AppBundle\Test\Behat;

use AppBundle\Test\TestCaseTrait;
use Behatch\Context\BaseContext;
use AppBundle\Factory\PrimeNumbersServiceFactory;
use AppBundle\Service\AbstractPrimeNumbersService as PrimeNumbersService;
use AppBundle\Service\QuantityPrimeNumbersService as QuantityNumbersService;
use AppBundle\Service\LastPrimeNumbersService as LastNumbersService;
use AppBundle\Entity\CommandOptionsInterface;
use AppBundle\Presenter\NumbersPresenterInterface;
use AppBundle\Presenter\NumbersTablePresenter;
use AppBundle\Calculator\Multiplication;

abstract class AbstractTestCase extends BaseContext
{
    use TestCaseTrait;

    /**
     * @param CommandOptionsInterface $options
     * @return PrimeNumbersService
     */
    protected function getPrimeNumbersService(CommandOptionsInterface $options): PrimeNumbersService
    {
        $primeNumbersServiceFactory = $this->getPrimeNumbersServiceFactory();

        $primeNumbersServiceFactory->setPrimeNumbersOptions($options);

        return $primeNumbersServiceFactory->getPrimeNumbersService();
    }

    /**
     * @return NumbersPresenterInterface
     */
    protected function getPresenter(): NumbersPresenterInterface
    {
        return new NumbersTablePresenter(
            new Multiplication()
        );
    }

    /**
     * @return PrimeNumbersServiceFactory
     */
    private function getPrimeNumbersServiceFactory(): PrimeNumbersServiceFactory
    {
        return new PrimeNumbersServiceFactory(
            $this->getLastNumbersService(),
            $this->getQuantityNumbersService()
        );
    }

    /**
     * @return LastNumbersService
     */
    private function getLastNumbersService(): LastNumbersService
    {
        return new LastNumbersService(
            $this->getNextPrimeNumberService(),
            $this->getPrimeNumberValidationService()
        );
    }

    /**
     * @return QuantityNumbersService
     */
    private function getQuantityNumbersService(): QuantityNumbersService
    {
        return new QuantityNumbersService(
            $this->getNextPrimeNumberService(),
            $this->getPrimeNumberValidationService()
        );
    }
}
