<?php

namespace App\Contracts;

interface TransactionServiceInterface extends EntityInterface {

    public function loadData();

    public function getTransactions($fromDate, $toDate);

    public function getValidTransaction($fromDate, $toDate);

    public function getCancelTransaction($fromDate, $toDate);

}
