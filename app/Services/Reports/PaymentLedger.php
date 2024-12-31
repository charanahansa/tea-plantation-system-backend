<?php

namespace App\Services\Reports;

use App\Concrete\ReportServiceInterface;

use App\Repositories\Master\SupplierRepository;
use App\Services\Reports\PaymentSummary;
use App\Services\Reports\PaymentDetail;

class PaymentLedger implements ReportServiceInterface{

    protected $objSupplierRepository;
    protected $objPaymentSummary;
    protected $objPaymentDetail;
    public function __construct(SupplierRepository $repoSupplierRepository,  PaymentSummary $repoPaymentSummary, PaymentDetail $repoPaymentDetail){

        $this->objSupplierRepository = $repoSupplierRepository;
        $this->objPaymentSummary = $repoPaymentSummary;
        $this->objPaymentDetail = $repoPaymentDetail;
    }

    public function loadData(){

        $listOfSuppliers = $this->objSupplierRepository->getAll();
        $listOfActiveSupplier = $listOfSuppliers->where('active', 1);

        $data['listOfActiveSuppliers'] = $listOfActiveSupplier;

        return $data;
    }

    public function generate($fromDate, $toDate, $reportType, $supplierId) {

        $generatedSummaryResult = $this->objPaymentSummary->preparePaymentSummaryRecords($fromDate, $toDate);
        if( $supplierId == 0 ){
            return $generatedSummaryResult;
        }


        // $generatedDetailResult =  $this->objPaymentDetail->preparePaymentDetailRecords($fromDate, $toDate);
        // return $generatedDetailResult;
    }

    public function prepare() {



    }

}
