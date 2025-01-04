<?php

namespace App\Services\Reports;

use App\Contracts\DataProcessorInterface;

use App\Services\Reports\PaymentSummary;
use App\Services\Reports\PaymentDetail;

class PaymentLedgerDataProcessorService implements DataProcessorInterface {

    protected $objPaymentSummary;
    protected $objPaymentDetail;

    public function __construct(PaymentSummary $repoPaymentSummary, PaymentDetail $repoPaymentDetail){

        $this->objPaymentSummary = $repoPaymentSummary;
        $this->objPaymentDetail = $repoPaymentDetail;
    }

    public function processData($input, $collectedData){

        if( ($input->reportType == 1) && ($input->supplierId == 0) ){

            return $this->objPaymentSummary->preparePaymentSummaryRecords($collectedData);
        }

        if( ($input->reportType == 1) && ($input->supplierId != 0) ){

            return $this->objPaymentSummary->preparePaymentSummaryRecords($collectedData);
        }

        if( ($input->reportType == 2) && ($input->supplierId == 0) ){

            return $this->objPaymentDetail->preparePaymentDetailRecords($collectedData);
        }

        if( ($input->reportType == 2) && ($input->supplierId != 0) ){

            return $this->objPaymentDetail->preparePaymentDetailRecords($collectedData);
        }
    }

}
