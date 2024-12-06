<?php

namespace App\Concrete;

interface TransactionInterface {

    public function getTransaction($fromDate, $toDate);

    public function getValidTransaction($fromDate, $toDate);

    public function getCancelTransaction($fromDate, $toDate);

}
