<?php
require 'vendor/autoload.php'; // Tự động load thư viện

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Tạo mới bảng tính
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

// Ghi file Excel
$writer = new Xlsx($spreadsheet);
$writer->save('hello_world.xlsx');

echo "Excel file created!";
