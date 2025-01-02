<?php

namespace App\Services\Reports;

class PaymentDetail {

    public function preparePaymentDetailRecords($collectedData){

        $listOfActiveSuppliers = $collectedData['listOfActiveSuppliers'];
        $listOfValidLrnTransaction = $collectedData['listOfValidLrnTransaction'];
        $listOfValidApnTransaction = $collectedData['listOfValidApnTransaction'];

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
