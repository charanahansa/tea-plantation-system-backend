<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Transaction\LeafReceiveNoteRequest;
use App\Services\Transaction\LeafReceiveService;

class LeafReceiveNoteController extends Controller {

    protected $objLeafReceiveService;
    public function __construct(LeafReceiveService $leafCategoryService){

        $this->objLeafReceiveService = $leafCategoryService;
    }

    public function saveLeafReceiveNote(LeafReceiveNoteRequest $request){

        $leafReceiveNote = $this->objLeafReceiveService->save($request->all());

        return response()->json($leafReceiveNote, 201);
    }

    public function findById(Request $request){

        $leafReceiveNote = $this->objLeafReceiveService->findById($request->id);

        return response()->json($leafReceiveNote, 200);
    }

    public function getTransactions(Request $request){

        $leafReceiveNote = $this->objLeafReceiveService->getTransactions($request->fromDate, $request->toDate);

        return response()->json($leafReceiveNote, 200);
    }

}
