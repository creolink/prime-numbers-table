<?php

namespace FundingBundle\Presenter;

use FundingBundle\Presenter\NumbersPresenterInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableStyle;
use FundingBundle\Presenter\AbstractNumbersPresenter;

class NumbersTablePresenter extends AbstractNumbersPresenter implements NumbersPresenterInterface
{
    /**
     * {@inheritDoc}
     */
    public function generateView(OutputInterface $output, array $numbers = [])
    {
        $results = $this->getResults($numbers);

        foreach ($results as $index => &$row) {
            array_unshift($row, $numbers[$index]);
        }

        $table = new Table($output);

        $table->setHeaders(
            $this->getHeader($numbers)
        );

        $table->setRows(
            $this->styleResults(
                $results
            )
        );

        $table->render();
    }

    /**
     * @param array $numbers
     * @return array
     */
    protected function getHeader(array $numbers): array
    {
        $header = $numbers;

        array_unshift($header, "");

        return $header;
    }

    /**
     * @param array $rows
     * @return array
     */
    protected function styleResults(array $rows): array
    {
        return $this->styleFirstColumn($rows);
    }

    /**
     * @param array $data
     * @return array
     */
    protected function styleFirstColumn(array $data = []): array
    {
        $style = $this->getHeaderStyle();

        foreach ($data as &$row) {
            $row[0] = sprintf($style, $row[0]);
        }

        return $data;
    }

    /**
     * @return string
     */
    protected function getHeaderStyle(): string
    {
        $tableStyle = new TableStyle();

        return $tableStyle->getCellHeaderFormat();
    }
}
