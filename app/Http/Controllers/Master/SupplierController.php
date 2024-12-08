<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Master\SupplierRequest;
use App\Services\Master\SupplierService;

class SupplierController extends Controller {

    protected $objSupplierService;
    public function __construct(SupplierService $supplierService){

        $this->objSupplierService = $supplierService;
    }

    public function saveSupplier(SupplierRequest $request){

        $supplier = $this->objSupplierService->save($request->all());

        return response()->json($supplier, 201);
    }

    public function getAll(){

        $supplierList = $this->objSupplierService->getAll();

        return response()->json($supplierList, 200);
    }

    public function getActiveAll(){

        $supplierActiveList = $this->objSupplierService->getActiveAll();

        return response()->json($supplierActiveList, 200);
    }

    public function getInactiveAll(){

        $supplierInactiveList = $this->objSupplierService->getInactiveAll();

        return response()->json($supplierInactiveList, 200);
    }

    public function findById(Request $request){

        $supplier = $this->objSupplierService->findById($request->id);

        return response()->json($supplier, 200);
    }


}
