<?php

namespace App\Contracts;

interface ReportServiceInterface {

    public function generate($fromDate, $toDate, $reportType, $supplierId);

    public function prepare();

}
