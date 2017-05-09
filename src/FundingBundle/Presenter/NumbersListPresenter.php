<?php

namespace FundingBundle\Presenter;

use FundingBundle\Presenter\NumbersPresenterInterface;
use Symfony\Component\Console\Output\OutputInterface;
use FundingBundle\Presenter\AbstractNumbersPresenter;

class NumbersListPresenter extends AbstractNumbersPresenter implements NumbersPresenterInterface
{
    /**
     * {@inheritDoc}
     */
    public function generateView(OutputInterface $output, array $numbers = [])
    {
        $results = $this->getResults($numbers);

        foreach ($results as $rowIndex => $row) {
            foreach ($row as $columnIndex => $value) {
                $output->writeln(
                    sprintf(
                        'Numbers: %s * %s, multiplication: %s',
                        $this->styleNumber($numbers[$rowIndex]),
                        $this->styleNumber($numbers[$columnIndex]),
                        $this->styleResult($value)
                    )
                );
            }
        }
    }

    /**
     * @param int $value
     * @return string
     */
    private function styleNumber(int $value)
    {
        return sprintf(
            '<info>%s</info>',
            $value
        );
    }

    /**
     * @param int $value
     * @return string
     */
    private function styleResult(int $value)
    {
        return sprintf(
            '<comment>%s</comment>',
            $value
        );
    }
}
