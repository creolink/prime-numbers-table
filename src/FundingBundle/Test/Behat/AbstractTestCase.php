<?php

namespace FundingBundle\Test\Behat;

use FundingBundle\Test\TestCaseTrait;
use Behatch\Context\BaseContext;
use FundingBundle\Factory\PrimeNumbersServiceFactory;
use FundingBundle\Service\AbstractPrimeNumbersService as PrimeNumbersService;
use FundingBundle\Service\QuantityPrimeNumbersService as QuantityNumbersService;
use FundingBundle\Service\LastPrimeNumbersService as LastNumbersService;
use FundingBundle\Entity\CommandOptionsInterface;
use FundingBundle\Presenter\NumbersPresenterInterface;
use FundingBundle\Presenter\NumbersTablePresenter;
use FundingBundle\Calculator\Multiplication;

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
