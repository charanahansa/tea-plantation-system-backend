<?php

namespace App\Contracts;

interface DataProcessorInterface {

    public function processData($input, $collectedData);

}
