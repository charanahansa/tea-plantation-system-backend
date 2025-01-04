<?php

namespace App\Services\Reports;

use App\Repositories\Master\SupplierRepository;

use App\Services\Reports\PaymentLedgerDataCollectorService;
use App\Services\Reports\PaymentLedgerDataProcessorService;
use App\Services\Reports\PaymentLedgerReportGeneratorService;

class PaymentLedgerService {

    protected $objSupplierRepository;
    protected $objPaymentLedgerDataCollectorService;
    protected $objPaymentLedgerDataProcessorService;
    protected $objPaymentLedgerReportGeneratorService;

    public function __construct(SupplierRepository $repoSupplierRepository,
                                PaymentLedgerDataCollectorService $repoPaymentLedgerDataCollectorService,
                                PaymentLedgerDataProcessorService $repoPaymentLedgerDataProcessorService,
                                PaymentLedgerReportGeneratorService $repoPaymentLedgerReportGeneratorService){

        $this->objSupplierRepository = $repoSupplierRepository;
        $this->objPaymentLedgerDataCollectorService = $repoPaymentLedgerDataCollectorService;
        $this->objPaymentLedgerDataProcessorService = $repoPaymentLedgerDataProcessorService;
        $this->objPaymentLedgerReportGeneratorService = $repoPaymentLedgerReportGeneratorService;
    }

    public function loadData(){

        $listOfSuppliers = $this->objSupplierRepository->getAll();
        $listOfActiveSuppliers = $listOfSuppliers->where('active', 1);

        $data['listOfActiveSuppliers'] = $listOfActiveSuppliers;

        return $data;
    }

    public function generate($input) {

        $collectedData = $this->objPaymentLedgerDataCollectorService->collectData($input);

        $processedData = $this->objPaymentLedgerDataProcessorService->processData($input, $collectedData);

        return $processedData;


    }

}
