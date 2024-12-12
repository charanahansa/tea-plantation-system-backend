<?php

namespace App\Repositories\Master;

use App\Concrete\EntityInterface;
use App\Concrete\MasterInterface;

use App\Models\Master\LeafCategory;

class LeafCategoryRepository implements EntityInterface, MasterInterface {

    public function save($tblLeafCategory){

        $leafCategory = LeafCategory::updateOrCreate(
                            ['id' => $tblLeafCategory['id'] ],
                            $tblLeafCategory
                        );

        return $leafCategory;
    }

    public function findById($id) {

        try {
            return LeafCategory::findOrFail($id);
        } catch (\Exception $e) {
            throw new \Exception('Leaf Category not found: ' . $e->getMessage());
        }
    }

    public function getAll() {

        try {
            return LeafCategory::all();
        } catch (\Exception $e) {
            throw new \Exception('Error fetching Leaf Categories: ' . $e->getMessage());
        }
    }
}
