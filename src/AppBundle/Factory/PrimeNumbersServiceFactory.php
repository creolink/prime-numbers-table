<?php

namespace AppBundle\Factory;

use AppBundle\Entity\CommandOptionsInterface;
use AppBundle\Service\QuantityPrimeNumbersService as QuantityNumbersService;
use AppBundle\Service\LastPrimeNumbersService as LastNumbersService;
use AppBundle\Service\AbstractPrimeNumbersService as PrimeNumbersService;

class PrimeNumbersServiceFactory
{
    /**
     * @var CommandOptionsInterface
     */
    private $options;

    /**
     * @var LastNumbersService
     */
    private $lastNumbersService;

    /**
     * @var QuantityNumbersService
     */
    private $quantityNumbersService;

    /**
     * @param LastNumbersService $lastNumbersService
     * @param QuantityNumbersService $quantityNumbersService
     */
    public function __construct(
        LastNumbersService $lastNumbersService,
        QuantityNumbersService $quantityNumbersService
    ) {
        $this->lastNumbersService = $lastNumbersService;
        $this->quantityNumbersService = $quantityNumbersService;
    }

    /**
     * @param CommandOptionsInterface $options
     */
    public function setPrimeNumbersOptions(CommandOptionsInterface $options)
    {
        $this->options = $options;
    }

    /**
     * @return PrimeNumbersService
     */
    public function getPrimeNumbersService(): PrimeNumbersService
    {
        if (!empty($this->options->getLast())) {
            $primeNumbersService = $this->lastNumbersService;
        } else {
            $primeNumbersService = $this->quantityNumbersService;
        }

        $primeNumbersService->setOptions($this->options);

        return $primeNumbersService;
    }
}
