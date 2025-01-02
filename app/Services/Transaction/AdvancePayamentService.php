<?php

namespace App\Services\Transaction;

use App\Contracts\TransactionServiceInterface;
use App\Repositories\Master\SupplierRepository;
use App\Repositories\Transaction\AdvancePaymentRepository;

use Carbon\Carbon;

class AdvancePayamentService implements TransactionServiceInterface {

    protected $objAdvancePaymentRepository;
    protected $objSupplierRepository;
    public function __construct(SupplierRepository $supplierRepository, AdvancePaymentRepository $AdvancePaymentRepository){

        $this->objAdvancePaymentRepository = $AdvancePaymentRepository;
        $this->objSupplierRepository = $supplierRepository;
    }

    public function loadData(){

        $today = Carbon::today();
        $listOfAdvancePayment = $this->objAdvancePaymentRepository->getTransactions('2024/10/01', $today->format('Y/m/d'));
        $listOfAdvancePayment = $listOfAdvancePayment->where('cancel', 0)->where('settle', 0);

        $suppliers = $this->objSupplierRepository->getAll();
        $activeSupplierList = $suppliers->where('active', 1);
        foreach($activeSupplierList as $supplierKey => $supplierValue){

            $totalOfAdvancePayment = $listOfAdvancePayment->where('supplier_id', $supplierValue->id)->sum('value');
            $supplierValue->totalOfAdvancePayment = $totalOfAdvancePayment;
        }

        $data['activeSupplierList'] = $activeSupplierList;

        return $data;
    }

    public function save($data){

        $tblAdvancePaymentNote["id"] = $data["apnId"];
        $tblAdvancePaymentNote["apn_date"] = $data["apnDate"];
        $tblAdvancePaymentNote["supplier_id"] = $data["supplierId"];
        $tblAdvancePaymentNote["value"] = $data["advanceAmount"];
        $tblAdvancePaymentNote["remark"] = $data["remark"];
        $tblAdvancePaymentNote["settle"] = 0;
        $tblAdvancePaymentNote["settle_on"] = null;
        $tblAdvancePaymentNote["cancel"] = 0;
        $tblAdvancePaymentNote["cancel_on"] = null;
        $tblAdvancePaymentNote["cancel_remark"] = null;

        return $this->objAdvancePaymentRepository->save($tblAdvancePaymentNote);
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
