<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Master\LeafCategoryRequest;
use App\Services\Master\LeafCategoryService;

class LeafCategoryController extends Controller {

    protected $objLeafCategoryService;

    public function __construct(LeafCategoryService $leafCategoryService){

        $this->objLeafCategoryService = $leafCategoryService;
    }

    public function saveLeafCategory(LeafCategoryRequest $request){

        $leafCategory = $this->objLeafCategoryService->save($request->all());

        return response()->json($leafCategory, 201);
    }

    public function getAll(){

        $leafCategoryList = $this->objLeafCategoryService->getAll();

        return response()->json($leafCategoryList, 200);
    }

    public function getActiveAll(){

        $leafCategoryActiveList = $this->objLeafCategoryService->getActiveAll();

        return response()->json($leafCategoryActiveList, 200);
    }

    public function getInactiveAll(){

        $leafCategoryInactiveList = $this->objLeafCategoryService->getInactiveAll();

        return response()->json($leafCategoryInactiveList, 200);
    }

    public function findById(Request $request){

        $leafCategory = $this->objLeafCategoryService->findById($request->id);

        return response()->json($leafCategory, 200);
    }
}
