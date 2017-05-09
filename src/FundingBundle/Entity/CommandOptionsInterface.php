<?php

namespace FundingBundle\Entity;

interface CommandOptionsInterface
{
    /**
     * @param int $start
     * @return CommandOptionsInterface
     */
    public function setStart(int $start): CommandOptionsInterface;

    /**
     * @return int
     */
    public function getStart(): int;

    /**
     * @param int $max
     * @return CommandOptionsInterface
     */
    public function setQuantity(int $max): CommandOptionsInterface;

    /**
     * @return int
     */
    public function getQuantity(): int;

    /**
     * @param int $last
     * @return CommandOptionsInterface
     */
    public function setLast($last): CommandOptionsInterface;

    /**
     * @return int
     */
    public function getLast(): int;
}
