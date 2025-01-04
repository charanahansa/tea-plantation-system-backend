<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Reports\PaymentLedgerService;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\User;

class PaymentLedgerController extends Controller {

    protected $objPaymentLedgerService;
    public function __construct(PaymentLedgerService $repoPaymentLedger){

        $this->objPaymentLedgerService = $repoPaymentLedger;
    }

    public function loadPyamentLedger(){

        $data = $this->objPaymentLedgerService->loadData();

        return response()->json($data, 200);
    }

    public function generatePyamentLedger(Request $request){

        $data['listOfPaymentLedger'] = $this->objPaymentLedgerService->generate($request);
        return response()->json($data, 200);

        // if( ($request->reportType == 1) && ($request->supplierId == 0) ){

        //     $data['listOfPaymentLedger'] = $this->objPaymentLedgerService->generate($request);
        //     return response()->json($data, 200);
        // }
    }

    public function generatePyamentLedgerExcel(Request $request){

        // Create a new spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Get the active sheet (the first sheet)
        $sheet = $spreadsheet->getActiveSheet();

        // Set column headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Created At');

        // Fetch data from the User model (or any data source)
        $users = User::all();
        $row = 2; // Start from the second row to insert data

        foreach ($users as $user) {
            // Insert data into each row
            $sheet->setCellValue('A' . $row, $user->id);
            $sheet->setCellValue('B' . $row, $user->name);
            $sheet->setCellValue('C' . $row, $user->email);
            $sheet->setCellValue('D' . $row, $user->created_at);
            $row++;
        }

        $sheet->getStyle('A1:D1')->getFont()->setBold(true);

        // Set column widths (optional)
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);

        // Create a writer to save the file in Excel 2007 format (.xlsx)
        $writer = new Xlsx($spreadsheet);

        // Set headers to force the download of the Excel file
        return response()->stream(
            function() use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment;filename="users.xlsx"',
                'Cache-Control' => 'max-age=0',
            ]
        );

    }

}
