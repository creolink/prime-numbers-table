<?php

namespace FundingBundle\Entity;

use FundingBundle\Entity\CommandOptionsInterface;

class PMCommandOption implements CommandOptionsInterface
{
    /**
     * @var int
     */
    private $start = 0;

    /**
     * @var int|null
     */
    private $quantity = 0;

    /**
     * @var int
     */
    private $last = 0;

    /**
     * @param int $start
     * @return CommandOptionsInterface
     */
    public function setStart(int $start): CommandOptionsInterface
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @return int
     */
    public function getStart(): int
    {
        return $this->start;
    }

    /**
     * @param int $quantity
     * @return CommandOptionsInterface
     */
    public function setQuantity(int $quantity): CommandOptionsInterface
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $last
     * @return CommandOptionsInterface
     */
    public function setLast($last): CommandOptionsInterface
    {
        $this->last = $last;

        return $this;
    }

    /**
     * @return int
     */
    public function getLast(): int
    {
        return $this->last;
    }
}
