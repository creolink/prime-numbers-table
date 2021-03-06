<?php

namespace AppBundle\Service;

abstract class AbstractNextPrimeNumberService
{
    /**
     * @param int $number
     * @return int
     */
    abstract public function getNumber(int $number): int;
}
