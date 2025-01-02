<?php

namespace App\Contracts;

interface TransactionInterface {

    public function getTransactions($fromDate, $toDate);

}
