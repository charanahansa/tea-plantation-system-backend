<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Reports\PaymentLedger;

class PaymentLedgerController extends Controller {

    protected $objPaymentLedgerService;
    public function __construct(PaymentLedger $repoPaymentLedger){

        $this->objPaymentLedgerService = $repoPaymentLedger;
    }

    public function loadPyamentLedger(){

        $data = $this->objPaymentLedgerService->loadData();

        return response()->json($data, 200);
    }

    public function generatePyamentLedger(Request $request){

        if( ($request->reportType == 1) && ($request->supplierId == 0) ){

            $data['listOfPaymentLedger'] = $this->objPaymentLedgerService->generate($request->fromDate, $request->toDate, $request->reportType, $request->supplier_id);
            return response()->json($data, 200);
        }


    }

}
