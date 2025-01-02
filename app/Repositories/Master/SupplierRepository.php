<?php

namespace App\Repositories\Master;

use App\Contracts\EntityInterface;
use App\Contracts\MasterInterface;

use App\Models\Master\Supplier;

class SupplierRepository implements EntityInterface, MasterInterface {

    public function save($tblSupplier){

        $supplier = Supplier::updateOrCreate(
                        ['id' => $tblSupplier['id'] ],
                        $tblSupplier
                    );

        return $supplier;
    }

    public function findById($id) {

        try {
            return Supplier::findOrFail($id);
        } catch (\Exception $e) {
            throw new \Exception('Supplier not found: ' . $e->getMessage());
        }
    }

    public function getAll() {

        try {
            return Supplier::all();
        } catch (\Exception $e) {
            throw new \Exception('Error fetching suppliers: ' . $e->getMessage());
        }
    }

}
