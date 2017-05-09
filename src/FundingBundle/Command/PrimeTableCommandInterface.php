<?php

namespace FundingBundle\Command;

interface PrimeTableCommandInterface
{
    const START_ARGUMENT = 'start';

    const QUANTITY_OPTION = 'quantity';
    const LAST_OPTION = 'last';

    const MAX_VALUE = 500;

    const COMMAND_NAME = 'funding:prime-table';
}
