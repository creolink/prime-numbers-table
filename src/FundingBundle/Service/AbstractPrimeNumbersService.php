<?php

namespace AppBundle\Service;

use AppBundle\Entity\CommandOptionsInterface;
use AppBundle\Service\AbstractNextPrimeNumberService as NextPrimeNumber;
use AppBundle\Service\PrimeNumberValidationService as PrimeNumberValidation;

abstract class AbstractPrimeNumbersService
{
    /**
     * @var NextPrimeNumber
     */
    protected $nextPrimeNumber;

    /**
     * @var PrimeNumberValidation
     */
    protected $primeNumberValidation;

    /**
     * @var CommandOptionsInterface
     */
    protected $options;

    /**
     * @param NextPrimeNumber $nextPrimeNumber
     * @param PrimeNumberValidation $primeNumberValidation
     */
    public function __construct(
        NextPrimeNumber $nextPrimeNumber,
        PrimeNumberValidation $primeNumberValidation
    ) {
        $this->nextPrimeNumber = $nextPrimeNumber;
        $this->primeNumberValidation = $primeNumberValidation;
    }

    /**
     * @param CommandOptionsInterface $options
     */
    public function setOptions(CommandOptionsInterface $options)
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    abstract public function getPrimeNumbers(): array;

    /**
     * @return array
     */
    protected function getFirstPrimeNumber(): array
    {
        $numbers = [];

        $number = $this->options->getStart();

        if ($this->primeNumberValidation->isPrime($number)) {
            $numbers[] = $number;
        }

        return $numbers;
    }
}
