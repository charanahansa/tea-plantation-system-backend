<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Transaction\AdvancePaymentNoteRequest;
use App\Services\Transaction\AdvancePayamentService;

class AdvancePayamentNoteController extends Controller {

    protected $objAdvancePaymentService;
    public function __construct(AdvancePayamentService $advancePayamentService){

        $this->objAdvancePaymentService = $advancePayamentService;
    }

    public function saveAdvancePaymentNote(AdvancePaymentNoteRequest $request){

        $leafReceiveNote = $this->objAdvancePaymentService->save($request->all());

        return response()->json($leafReceiveNote, 201);
    }

    public function findById(Request $request){

        $leafReceiveNote = $this->objAdvancePaymentService->findById($request->id);

        return response()->json($leafReceiveNote, 200);
    }

    public function getTransactions(Request $request){

        $leafReceiveNote = $this->objAdvancePaymentService->getTransactions($request->fromDate, $request->toDate);

        return response()->json($leafReceiveNote, 200);
    }


}
