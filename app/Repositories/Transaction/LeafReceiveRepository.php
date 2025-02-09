<?php

namespace App\Repositories\Transaction;

use App\Contracts\EntityInterface;
use App\Contracts\TransactionInterface;

use App\Models\Transaction\LeafReceiveNote;

class LeafReceiveRepository implements EntityInterface, TransactionInterface {

    public function save($tblLeafReceiveNote){

        $leafReceiveNote = LeafReceiveNote::updateOrCreate(
                                ['id' => $tblLeafReceiveNote['id'] ],
                                $tblLeafReceiveNote
                            );

        return $leafReceiveNote;
    }

    public function findById($id) {

        try {
            return LeafReceiveNote::findOrFail($id);
        } catch (\Exception $e) {
            throw new \Exception('Leaf Receive Note not found: ' . $e->getMessage());
        }
    }

    public function getTransactions($fromDate, $toDate){

        try {
            return LeafReceiveNote::whereBetween('lrn_date', [$fromDate, $toDate])->get();
        } catch (\Exception $e) {
            throw new \Exception('Leaf Receive Note not found: ' . $e->getMessage());
        }
    }
}
