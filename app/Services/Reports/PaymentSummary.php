<?php

namespace App\Services\Reports;

use App\Repositories\Master\SupplierRepository;
use App\Repositories\Transaction\LeafReceiveRepository;
use App\Repositories\Transaction\AdvancePaymentRepository;

class PaymentSummary {

    protected $objSupplierRepository;
    protected $objLeafReceiveRepository;
    protected $objAdvancePaymentRepository;

    public function __construct(SupplierRepository $repoSupplierRepository, LeafReceiveRepository $repoLeafReceiveRepository, AdvancePaymentRepository $repoAdvancePaymentRepository) {

        $this->objSupplierRepository = $repoSupplierRepository;
        $this->objLeafReceiveRepository = $repoLeafReceiveRepository;
        $this->objAdvancePaymentRepository = $repoAdvancePaymentRepository;
    }

    public function preparePaymentSummaryRecords($fromDate, $toDate){

        $listOfSuppliers = $this->objSupplierRepository->getAll();
        $listOfActiveSuppliers =  $listOfSuppliers->where('active', 1);

        $listOfLrnTransaction = $this->objLeafReceiveRepository->getTransactions($fromDate, $toDate);
        $listOfValidLrnTransaction = $listOfLrnTransaction->where('cancel', 0);

        $listOfApnTransaction = $this->objAdvancePaymentRepository->getTransactions($fromDate, $toDate);
        $listOfValidApnTransaction = $listOfApnTransaction->where('cancel', 0);

        $colPaymentInformation = collect();
        foreach($listOfActiveSuppliers as $supplierKey => $supplierValue){

            $totalOfSupplierLeafCollection = $listOfValidLrnTransaction->where('supplier_id', $supplierValue->id)->sum('lrn_balance');
            $totalOfSupplierAdvanceCollection = $listOfValidApnTransaction->where('supplier_id', $supplierValue->id)->sum('value');

            $paymentInformation['id'] = ($supplierKey + 1);
            $paymentInformation['supplier_id'] = $supplierValue->id;
            $paymentInformation['supplier_name'] = $supplierValue->supplier_name;
            $paymentInformation['collection_amount'] = $totalOfSupplierLeafCollection;
            $paymentInformation['advance_amount'] = $totalOfSupplierAdvanceCollection;
            $paymentInformation['net_amount'] = ($totalOfSupplierLeafCollection - $totalOfSupplierAdvanceCollection);

            $colPaymentInformation->push($paymentInformation);
        }

        return $colPaymentInformation;
    }


}
