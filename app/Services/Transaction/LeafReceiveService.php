<?php

namespace App\Services\Transaction;

use App\Contracts\TransactionServiceInterface;
use App\Repositories\Master\SupplierRepository;
use App\Repositories\Master\LeafCategoryRepository;
use App\Repositories\Transaction\LeafReceiveRepository;

class LeafReceiveService implements TransactionServiceInterface {

    protected $objLeafReceiveRepository;
    protected $objSupplierRepository;
    protected $objLeafCategoryRepository;

    public function __construct(SupplierRepository $supplierRepository, LeafCategoryRepository $leafCategoryRepository,  LeafReceiveRepository $LeafReceiveRepository ){

        $this->objLeafReceiveRepository = $LeafReceiveRepository;
        $this->objSupplierRepository = $supplierRepository;
        $this->objLeafCategoryRepository = $leafCategoryRepository;
    }

    public function loadData(){

        $suppliers = $this->objSupplierRepository->getAll();
        $leafCategories = $this->objLeafCategoryRepository->getAll();

        $data['activeSupplierList'] = $suppliers->where('active', 1);
        $data['activeLeafCategoryList'] = $leafCategories->where('active', 1);

        return $data;
    }

    public function save($data){

        $tblLeafReceiveNote["id"] = $data["lrnId"];
        $tblLeafReceiveNote["lrn_date"] = $data["lrnDate"];
        $tblLeafReceiveNote["supplier_id"] = $data["supplierId"];
        $tblLeafReceiveNote["lc_id"] = $data["leafCategoryId"];
        $tblLeafReceiveNote["price"] = $data["price"];
        $tblLeafReceiveNote["weight"] = $data["weight"];
        $tblLeafReceiveNote["lrn_value"] = $data["amount"];
        $tblLeafReceiveNote["lrn_balance"] = $data["amount"];
        $tblLeafReceiveNote["remark"] = $data["remark"];
        $tblLeafReceiveNote["cancel"] = 0;
        $tblLeafReceiveNote["cancel_on"] = null;
        $tblLeafReceiveNote["cancel_remark"] = null;

        return $this->objLeafReceiveRepository->save($tblLeafReceiveNote);
    }

    public function findById($id){

        try {
            return $this->objLeafReceiveRepository->findById($id);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching leaf category: ' . $e->getMessage());
        }
    }

    public function getTransactions($fromDate, $toDate){

        try {
            return $this->objLeafReceiveRepository->getTransactions($fromDate, $toDate);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching leaf category: ' . $e->getMessage());
        }
    }

    public function getValidTransaction($fromDate, $toDate){


    }

    public function getCancelTransaction($fromDate, $toDate){


    }
}
