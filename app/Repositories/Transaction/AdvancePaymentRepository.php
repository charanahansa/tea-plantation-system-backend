<?php

namespace App\Repositories\Transaction;

use App\Contracts\EntityInterface;
use App\Contracts\TransactionInterface;

use App\Models\Transaction\AdvancePaymentNote;

class AdvancePaymentRepository implements EntityInterface, TransactionInterface {

    public function save($tblAdvancePaymentNote){

        $savedAdvancePayamentNote = AdvancePaymentNote::updateOrCreate(
                                        ['id' => $tblAdvancePaymentNote['id'] ],
                                        $tblAdvancePaymentNote
                                    );

        return $savedAdvancePayamentNote;
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
            return AdvancePaymentNote::whereBetween('apn_date', [$fromDate, $toDate])->get();
        } catch (\Exception $e) {
            throw new \Exception('Advance Payament Note not found: ' . $e->getMessage());
        }
    }


}
