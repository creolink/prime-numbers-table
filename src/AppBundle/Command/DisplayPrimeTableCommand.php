<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use AppBundle\Command\PrimeTableCommandInterface;
use AppBundle\Entity\PMCommandOption;
use AppBundle\Entity\CommandOptionsInterface;
use AppBundle\Service\AbstractPrimeNumbersService as PrimeNumbersService;
use AppBundle\Factory\PrimeNumbersServiceFactory;
use AppBundle\Presenter\NumbersPresenterInterface;

class DisplayPrimeTableCommand extends ContainerAwareCommand implements PrimeTableCommandInterface
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription('Prints out a multiplication table of the prime numbers.')
            ->setHelp(
                sprintf(
                    'Set start number with "%s" argument, default it is 0.'
                    . ' If you want to generate table with N numbers, set "%s" option.'
                    . ' If you want to set last prime number, set "%s" option.',
                    self::START_ARGUMENT,
                    self::QUANTITY_OPTION,
                    self::LAST_OPTION
                )
            );

        $this->configureArguments();
        $this->configureOptions();
    }

    protected function configureOptions()
    {
        $this
            ->addOption(self::QUANTITY_OPTION, null, InputOption::VALUE_OPTIONAL, 'Quantity of numbers for prime number generator.', 0)
            ->addOption(self::LAST_OPTION, null, InputOption::VALUE_OPTIONAL, 'Last prime number for multiplication.', 0);
    }

    protected function configureArguments()
    {
        $this
            ->addArgument(self::START_ARGUMENT, InputArgument::OPTIONAL, 'First number.', 0);
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $optionsEntity = $this->createPMCommandOption($input);

        if (!$this->validateOptions($optionsEntity)) {
            return $this->displayOptionsError($output);
        }

        $optionsService = $this->getPrimeNumbersService($optionsEntity);

        $numbers = $optionsService->getPrimeNumbers();

        if (empty($numbers)) {
            return $this->displayNumbersError($output);
        }

        $this->getPrimeNumbersPresenter()->generateView($output, $numbers);
    }

    /**
     * @param CommandOptionsInterface $options
     * @return bool
     */
    protected function validateOptions(CommandOptionsInterface $options): bool
    {
        if (empty($options->getLast())
            && empty($options->getQuantity())
        ) {
            return false;
        }

        if ($options->getLast() > self::MAX_VALUE) {
            return false;
        }

        if ($options->getStart() > self::MAX_VALUE) {
            return false;
        }

        if ($options->getQuantity() > self::MAX_VALUE) {
            return false;
        }

        return true;
    }

    /**
     * @param InputInterface $input
     * @return CommandOptionsInterface
     */
    protected function createPMCommandOption(InputInterface $input): CommandOptionsInterface
    {
        $entity = new PMCommandOption();

        $entity->setQuantity(
            intval($input->getOption(self::QUANTITY_OPTION))
        );

        $entity->setLast(
            intval($input->getOption(self::LAST_OPTION))
        );

        $entity->setStart(
            intval($input->getArgument(self::START_ARGUMENT))
        );

        return $entity;
    }

    /**
     * @param OutputInterface $output
     */
    protected function displayOptionsError(OutputInterface $output)
    {
        $output->writeln(
            sprintf(
                '<error>Please fill one of options "%s" or "%s". '
                    .'Use only integer values no bigger than %s. '
                    .'Please use --help for more info.</error>',
                self::QUANTITY_OPTION,
                self::LAST_OPTION,
                self::MAX_VALUE
            )
        );
    }

    /**
     * @param OutputInterface $output
     */
    protected function displayNumbersError(OutputInterface $output)
    {
        $output->writeln(
            '<error>No prime numbers generated.</error>'
        );
    }

    /**
     * @param CommandOptionsInterface $options
     * @return PrimeNumbersService
     */
    private function getPrimeNumbersService(CommandOptionsInterface $options): PrimeNumbersService
    {
        $this->getPrimeNumbersServiceFactory()
            ->setPrimeNumbersOptions($options);

        return $this->getPrimeNumbersServiceFactory()
            ->getPrimeNumbersService();
    }

    /**
     * @return PrimeNumbersServiceFactory
     */
    private function getPrimeNumbersServiceFactory(): PrimeNumbersServiceFactory
    {
        return $this->getContainer()->get('app.prime_numbers_service.factory');
    }

    /**
     * @return NumbersPresenterInterface
     */
    private function getPrimeNumbersPresenter(): NumbersPresenterInterface
    {
        return $this->getContainer()->get('app.prime_numbers.presenter');
    }
}
