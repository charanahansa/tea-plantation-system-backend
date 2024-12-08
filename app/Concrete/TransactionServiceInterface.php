<?php

namespace App\Concrete;

interface TransactionServiceInterface extends EntityInterface {

    public function getTransactions($fromDate, $toDate);

    public function getValidTransaction($fromDate, $toDate);

    public function getCancelTransaction($fromDate, $toDate);

}
