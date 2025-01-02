<?php

namespace App\Services\Reports;

class PaymentSummary {

    public function preparePaymentSummaryRecords($collectedData){

        $listOfActiveSuppliers = $collectedData['listOfActiveSuppliers'];
        $listOfValidLrnTransaction = $collectedData['listOfValidLrnTransaction'];
        $listOfValidApnTransaction = $collectedData['listOfValidApnTransaction'];

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
