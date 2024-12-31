<?php

namespace App\Services\Reports;

use App\Repositories\Master\SupplierRepository;
use App\Repositories\Transaction\LeafReceiveRepository;
use App\Repositories\Transaction\AdvancePaymentRepository;

class PaymentDetail {

    protected $objSupplierRepository;
    protected $objLeafReceiveRepository;
    protected $objAdvancePaymentRepository;

    public function __construct(SupplierRepository $repoSupplierRepository, LeafReceiveRepository $repoLeafReceiveRepository, AdvancePaymentRepository $repoAdvancePaymentRepository) {

        $this->objSupplierRepository = $repoSupplierRepository;
        $this->objLeafReceiveRepository = $repoLeafReceiveRepository;
        $this->objAdvancePaymentRepository = $repoAdvancePaymentRepository;
    }

    public function preparePaymentDetailRecords($fromDate, $toDate){

        $listOfSuppliers = $this->objSupplierRepository->getAll();
        $listOfActiveSuppliers =  $listOfSuppliers->where('active', 1);

        $listOfLrnTransaction = $this->objLeafReceiveRepository->getTransactions($fromDate, $toDate);
        $listOfValidLrnTransaction = $listOfLrnTransaction->where('cancel', 0);

        $listOfApnTransaction = $this->objAdvancePaymentRepository->getTransactions($fromDate, $toDate);
        $listOfValidApnTransaction = $listOfApnTransaction->where('cancel', 0);

        $colPaymentInformation = collect();
        foreach($listOfActiveSuppliers as $supplierKey => $supplierValue){

            $listOfValidSupplierLrnTransaction = $listOfValidLrnTransaction->where('supplier_id', $supplierValue->id);
            foreach($listOfValidSupplierLrnTransaction as $lrnKey => $lrnValue){

                $paymentInformation['id'] = ($supplierKey + 1);
                $paymentInformation['supplier_id'] = $supplierValue->id;
                $paymentInformation['supplier_name'] = $supplierValue->supplier_name;
                $paymentInformation['source'] = "lrn";
                $paymentInformation['source_no'] = $lrnValue->id;
                $paymentInformation['source_date'] = $lrnValue->lrn_date;
                $paymentInformation['source_amount'] = $lrnValue->lrn_balance;

                $colPaymentInformation->push($paymentInformation);
            }

            $listOfValidSupplierApnTransaction = $listOfValidApnTransaction->where('supplier_id', $supplierValue->id);
            foreach($listOfValidSupplierApnTransaction as $apnKey => $apnValue){

                $paymentInformation['id'] = ($supplierKey + 1);
                $paymentInformation['supplier_id'] = $supplierValue->id;
                $paymentInformation['supplier_name'] = $supplierValue->supplier_name;
                $paymentInformation['source'] = "apn";
                $paymentInformation['source_no'] = $apnValue->id;
                $paymentInformation['source_date'] = $apnValue->apn_date;
                $paymentInformation['source_amount'] = $apnValue->value;

                $colPaymentInformation->push($paymentInformation);
            }
        }

        return $colPaymentInformation;
    }

}
