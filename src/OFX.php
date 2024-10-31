<?php

namespace OFXReader;

use OFXReader\Entity\Transaction;

class OFX
{
    private array $transactions;

    public function __construct()
    {
        $this->transactions = [];
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
