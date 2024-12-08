<?php

namespace App\Services\Transaction;

use App\Concrete\TransactionServiceInterface;
use App\Repositories\Transaction\LeafReceiveRepository;

class LeafReceiveService implements TransactionServiceInterface {

    protected $objLeafReceiveRepository;
    public function __construct(LeafReceiveRepository $LeafReceiveRepository){

        $this->objLeafReceiveRepository = $LeafReceiveRepository;
    }

    public function save($data){

        return $this->objLeafReceiveRepository->save($data);
    }

    public function findById($id){

        try {
            return $this->objLeafReceiveRepository->findById($id);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching leaf category: ' . $e->getMessage());
        }
    }

    public function getTransactions($fromDate, $toDate){

        try {
            return $this->objLeafReceiveRepository->getTransactions($fromDate, $toDate);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching leaf category: ' . $e->getMessage());
        }
    }

    public function getValidTransaction($fromDate, $toDate){


    }

    public function getCancelTransaction($fromDate, $toDate){


    }
}
