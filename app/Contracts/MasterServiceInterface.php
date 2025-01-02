<?php

namespace App\Contracts;

interface MasterServiceInterface extends EntityInterface {

    public function getAll();

    public function getActiveAll();

    public function getInactiveAll();

}
