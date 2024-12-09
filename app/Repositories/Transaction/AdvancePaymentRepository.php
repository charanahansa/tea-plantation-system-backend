<?php

namespace App\Repositories\Transaction;

use App\Concrete\EntityInterface;
use App\Concrete\TransactionInterface;

use App\Models\Transaction\AdvancePaymentNote;

class AdvancePaymentRepository implements EntityInterface, TransactionInterface {

    public function save($data){

        $advancePayamentNote = AdvancePaymentNote::updateOrCreate(
                        ['id' => $data['id'] ],
                        $data
                    );

        return $advancePayamentNote;
    }

    public function findById($id) {

        try {
            return AdvancePaymentNote::findOrFail($id);
        } catch (\Exception $e) {
            throw new \Exception('Advance Payament Note not found: ' . $e->getMessage());
        }
    }

    public function getTransactions($fromDate, $toDate){

        try {
            return AdvancePaymentNote::whereBetween('ap_date', [$fromDate, $toDate])->get();
        } catch (\Exception $e) {
            throw new \Exception('Advance Payament Note not found: ' . $e->getMessage());
        }
    }


}
