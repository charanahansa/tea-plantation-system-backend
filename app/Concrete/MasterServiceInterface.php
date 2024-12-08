<?php

namespace App\Concrete;

interface MasterServiceInterface extends EntityInterface {

    public function getAll();

    public function getActiveAll();

    public function getInactiveAll();

}
