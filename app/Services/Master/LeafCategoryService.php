<?php

namespace App\Services\Master;

use App\Concrete\MasterServiceInterface;
use App\Repositories\Master\LeafCategoryRepository;

class LeafCategoryService implements MasterServiceInterface {

    protected $objLeafCategoryRepository;
    public function __construct(LeafCategoryRepository $LeafCategoryRepository){

        $this->objLeafCategoryRepository = $LeafCategoryRepository;
    }

    public function save($data){

        return $this->objLeafCategoryRepository->save($data);
    }

    public function findById($id) {

        try {
            return $this->objLeafCategoryRepository->findById($id);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching leaf category: ' . $e->getMessage());
        }
    }

    public function getAll() {

        try {
            return $this->objLeafCategoryRepository->getAll();
        } catch (\Exception $e) {
            throw new \Exception('Error fetching leaf categories: ' . $e->getMessage());
        }
    }

    public function getActiveAll() {

        try {
            $leafCategoryList = $this->objLeafCategoryRepository->getAll();
            return $leafCategoryList->where('active', 1);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching active leaf categories: ' . $e->getMessage());
        }
    }

    public function getInactiveAll() {

        try {
            $leafCategoryList = $this->objLeafCategoryRepository->getAll();
            return $leafCategoryList->where('active', 0);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching inactive leaf categories: ' . $e->getMessage());
        }
    }

}
