<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include "koneksi.php";

// Create a new instance of Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Headers
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Suhu');
$sheet->setCellValue('C1', 'Kelembaban');
$sheet->setCellValue('D1', 'Polusi');
$sheet->setCellValue('E1', 'Result');

// Fetch data from the database
$data = mysqli_query($conn, "SELECT * FROM udara");
$no = 2;

while ($ud = mysqli_fetch_array($data)) {
    $sheet->setCellValue('A' . $no, $no - 1);
    $sheet->setCellValue('B' . $no, $ud['suhu']);
    $sheet->setCellValue('C' . $no, $ud['kelembaban']);
    $sheet->setCellValue('D' . $no, $ud['polusi']);
    $sheet->setCellValue('E' . $no, $ud['kualitas_udara']);
    $no++;
}

// Set appropriate headers for file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="udara_data.xlsx"');
header('Cache-Control: max-age=0');
header('Content-Length: ' . ob_get_length()); // Add this line

// Clear any output buffers to ensure proper file download
ob_end_clean(); // Add this line

// Save the spreadsheet to php://output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit(); // Add this line
?>
