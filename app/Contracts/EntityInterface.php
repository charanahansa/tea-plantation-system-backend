<?php

namespace App\Contracts;

interface EntityInterface {

    public function save($data);

    public function findById($id);

}
