<?php

namespace OFXReader;

use DateTimeInterface;
use OFXReader\Entity\Transaction;

class OFX extends Serializable
{
    private DateTimeInterface $startDate;
    private DateTimeInterface $endDate;
    private array $transactions;

    public function __construct()
    {
        $this->transactions = [];
    }

    public function setStartDate(DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function startDate(): DateTimeInterface
    {
        return $this->startDate;
    }


    public function setEndDate(DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function endDate(): DateTimeInterface
    {
        return $this->endDate;
    }

    public function addTransaction(Transaction $transaction)
    {
        $this->transactions[] = $transaction;
    }

    /** @return Transaction[] */
    public function transactions(): array
    {
        return $this->transactions;
    }
}
