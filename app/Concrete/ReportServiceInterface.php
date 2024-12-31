<?php

namespace App\Concrete;

interface ReportServiceInterface {

    public function generate($fromDate, $toDate, $reportType, $supplierId);

    public function prepare();

}
