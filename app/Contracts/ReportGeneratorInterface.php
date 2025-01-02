<?php

namespace App\Contracts;

interface ReportGeneratorInterface {

    public function generateReport($input, $processedData);

}
