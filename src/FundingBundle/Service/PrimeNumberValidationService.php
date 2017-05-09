<?php

namespace FundingBundle\Service;

class PrimeNumberValidationService
{
    /**
     * @param int $number
     * @return bool
     */
    public function isPrime($number): bool
    {
        /**
         * 1 is not prime. See: http://en.wikipedia.org/wiki/Prime_number#Primality_of_one
         */
        if ($number <= 1) {
            return false;
        }

        /**
         * 2 is prime (the only even number that is prime)
         */
        if ($number == 2) {
            return true;
        }

        /**
         * if the number is divisible by two, then it's not prime and it's no longer
         * needed to check other even numbers
         */
        if ($number % 2 == 0) {
            return false;
        }

        return $this->checkOddNumber($number);
    }

    /**
     * Checks the odd numbers. If any of them is a factor, then it returns false.
     * The sqrt can be an approximation, hence just for the sake of
     * security, one rounds it to the next highest integer value.
     *
     * @param int $number
     * @return bool
     */
    private function checkOddNumber(int $number): bool
    {
        $ceil = ceil(sqrt($number));

        for ($i = 3; $i <= $ceil; $i = $i + 2) {
            if ($number % $i == 0) {
                return false;
            }
        }

        return true;
    }
}
