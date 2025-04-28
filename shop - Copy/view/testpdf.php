<?php
require('../../helo/fpdf.php'); // Gọi thư viện FPDF

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Xin chào FPDF!');
$pdf->Output();
