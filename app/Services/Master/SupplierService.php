<?php

namespace App\Services\Master;

use App\Concrete\MasterServiceInterface;

use App\Repositories\Master\SupplierRepository;

class SupplierService implements MasterServiceInterface {

    protected $repSupplierService;

    public function __construct(SupplierRepository $supplierRepository){

        $this->repSupplierService = $supplierRepository;
    }

    public function save($data){

        return $this->repSupplierService->save($data);
    }

    public function findById($id) {

        try {
            return $this->repSupplierService->findById($id);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching supplier: ' . $e->getMessage());
        }
    }

    public function getAll() {

        try {
            return $this->repSupplierService->getAll();
        } catch (\Exception $e) {
            throw new \Exception('Error fetching suppliers: ' . $e->getMessage());
        }
    }

    public function getActiveAll() {

        try {
            $supplierList = $this->repSupplierService->getAll();
            return $supplierList->where('active', 1);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching active suppliers: ' . $e->getMessage());
        }
    }

    public function getInactiveAll() {

        try {
            $supplierList = $this->repSupplierService->getAll();
            return $supplierList->where('active', 0);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching inactive suppliers: ' . $e->getMessage());
        }
    }

}
