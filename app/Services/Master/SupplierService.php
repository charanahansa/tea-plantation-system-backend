<?php

namespace App\Services\Master;

use App\Concrete\MasterServiceInterface;

use App\Repositories\Master\SupplierRepository;

class SupplierService implements MasterServiceInterface {

    protected $objSupplierRepository;
    public function __construct(SupplierRepository $supplierRepository){

        $this->objSupplierRepository = $supplierRepository;
    }

    public function save($data){

        return $this->objSupplierRepository->save($data);
    }

    public function findById($id) {

        try {
            return $this->objSupplierRepository->findById($id);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching supplier: ' . $e->getMessage());
        }
    }

    public function getAll() {

        try {
            return $this->objSupplierRepository->getAll();
        } catch (\Exception $e) {
            throw new \Exception('Error fetching suppliers: ' . $e->getMessage());
        }
    }

    public function getActiveAll() {

        try {
            $supplierList = $this->objSupplierRepository->getAll();
            return $supplierList->where('active', 1);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching active suppliers: ' . $e->getMessage());
        }
    }

    public function getInactiveAll() {

        try {
            $supplierList = $this->objSupplierRepository->getAll();
            return $supplierList->where('active', 0);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching inactive suppliers: ' . $e->getMessage());
        }
    }

}
