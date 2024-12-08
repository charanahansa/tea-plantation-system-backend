<?php

namespace App\Concrete;

interface EntityInterface {

    public function save($data);

    public function findById($id);

}
