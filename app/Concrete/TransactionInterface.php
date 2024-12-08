<?php

namespace App\Concrete;

interface TransactionInterface {

    public function getTransactions($fromDate, $toDate);

}
