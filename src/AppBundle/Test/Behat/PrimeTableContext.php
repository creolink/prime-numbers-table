<?php

namespace AppBundle\Test\Behat;

use AppBundle\Test\Behat\AbstractTestCase;
use AppBundle\Entity\CommandOptionsInterface;

class PrimeTableContext extends AbstractTestCase
{
    /**
     * @var CommandOptionsInterface
     */
    private $commandOption;

    /**
     * @var array
     */
    private $primeNumbers;

    /**
     * @Given I do not provide any parameters
     */
    public function iDoNotProvideAnyParameters()
    {
        $this->commandOption = $this->createPMCommandOption();
    }

    /**
     * @When I execute command
     */
    public function iExecuteCommand()
    {
        $service = $this->getPrimeNumbersService(
            $this->commandOption
        );

        $this->primeNumbers = $service->getPrimeNumbers();
    }

    /**
     * @Then I should get empty table
     */
    public function iShouldGetEmptyTable()
    {
        $this->iShouldGetPrimeNumbers(0);
    }

    /**
     * @Given I provide :quantity in command
     *
     * @param int $quantity
     */
    public function iProvideInCommand($quantity)
    {
        $this->commandOption = $this->createPMCommandOption();

        $this->commandOption->setQuantity($quantity);
    }

    /**
     * @Then I should get :total prime numbers
     *
     * @param int $total
     */
    public function iShouldGetPrimeNumbers($total)
    {
        $this->assertCount($total, $this->primeNumbers);
    }

    /**
     * @Then I should get table with :minMultiplication value
     *
     * @param int $minMultiplication
     */
    public function iShouldGetTableWithValue($minMultiplication)
    {
        $results = $this->getPresenter()
                ->getResults($this->primeNumbers);

        $minimumValue = null;

        foreach ($results as $row) {
            if (!is_null($minimumValue)) {
                array_unshift($row, $minimumValue);
            }

            $minimumValue = min($row);
        }

        $this->assertEquals($minMultiplication, $minimumValue);
    }

    /**
     * @Then table should contain :maxMultiplication
     *
     * @param int $maxMultiplication
     */
    public function tableShouldContain($maxMultiplication)
    {
        $results = $this->getPresenter()
                ->getResults($this->primeNumbers);

        $maximumValue = null;
        foreach ($results as $row) {
            if (!is_null($maximumValue)) {
                array_unshift($row, $maximumValue);
            }

            $maximumValue = max($row);
        }

        $this->assertEquals($maxMultiplication, $maximumValue);
    }
}
