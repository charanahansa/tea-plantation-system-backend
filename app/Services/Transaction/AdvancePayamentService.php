<?php

namespace App\Services\Transaction;

use App\Concrete\TransactionServiceInterface;
use App\Repositories\Transaction\AdvancePaymentRepository;

class AdvancePayamentService implements TransactionServiceInterface {

    protected $objAdvancePaymentRepository;
    public function __construct(AdvancePaymentRepository $AdvancePaymentRepository){

        $this->objAdvancePaymentRepository = $AdvancePaymentRepository;
    }

    public function save($data){

        return $this->objAdvancePaymentRepository->save($data);
    }

    public function findById($id){

        try {
            return $this->objAdvancePaymentRepository->findById($id);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching leaf category: ' . $e->getMessage());
        }
    }

    public function getTransactions($fromDate, $toDate){

        try {
            return $this->objAdvancePaymentRepository->getTransactions($fromDate, $toDate);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching leaf category: ' . $e->getMessage());
        }
    }

    public function getValidTransaction($fromDate, $toDate){


    }

    public function getCancelTransaction($fromDate, $toDate){


    }

}
