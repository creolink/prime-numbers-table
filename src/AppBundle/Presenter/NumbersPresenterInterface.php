<?php

namespace AppBundle\Presenter;

use Symfony\Component\Console\Output\OutputInterface;

interface NumbersPresenterInterface
{
    /**
     * @param OutputInterface $output
     * @param array $numbers
     */
    public function generateView(OutputInterface $output, array $numbers = []);

    /**
     * @param array $numbers
     * @return array
     */
    public function getResults(array $numbers): array;
}
