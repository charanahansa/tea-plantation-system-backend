<?php

namespace App\Services\Reports;

use App\Contracts\DataCollectorInterface;

use App\Repositories\Master\SupplierRepository;

use App\Repositories\Transaction\LeafReceiveRepository;
use App\Repositories\Transaction\AdvancePaymentRepository;

class PaymentLedgerDataCollectorService implements DataCollectorInterface {

    protected $objSupplierRepository;
    protected $objLeafReceiveRepository;
    protected $objAdvancePaymentRepository;

    public function __construct(SupplierRepository $repoSupplierRepository, LeafReceiveRepository $repoLeafReceiveRepository, AdvancePaymentRepository $repoAdvancePaymentRepository) {

        $this->objSupplierRepository = $repoSupplierRepository;
        $this->objLeafReceiveRepository = $repoLeafReceiveRepository;
        $this->objAdvancePaymentRepository = $repoAdvancePaymentRepository;
    }

    public function collectData($input){

        $listOfSuppliers = $this->objSupplierRepository->getAll();
        $listOfActiveSuppliers =  $listOfSuppliers->where('active', 1);

        $listOfLrnTransaction = $this->objLeafReceiveRepository->getTransactions($input->fromDate, $input->toDate);
        $listOfValidLrnTransaction = $listOfLrnTransaction->where('cancel', 0);

        $listOfApnTransaction = $this->objAdvancePaymentRepository->getTransactions($input->fromDate, $input->toDate);
        $listOfValidApnTransaction = $listOfApnTransaction->where('cancel', 0);

        return  [
                    "listOfActiveSuppliers" => $listOfActiveSuppliers,
                    "listOfValidLrnTransaction" => $listOfValidLrnTransaction,
                    "listOfValidApnTransaction" => $listOfValidApnTransaction
                ];
    }

}
