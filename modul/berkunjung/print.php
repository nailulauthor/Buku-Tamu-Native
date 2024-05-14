<?php
require_once ('tcpdf/tcpdf.php');
// require 'berkunjung.php';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Griya Pisma Jaya');
$pdf->setTitle('Data Tamu Berkunjung');
$pdf->setSubject('Data Tamu Berkunjung');
$pdf->setKeywords('Data Tamu Berkunjung');

$pdf->setFont('times', '', 12, '', true);
$pdf->Cell(0, 10, 0, 1, 'C');
$pdf->setPrintHeader(false);
$pdf->AddPage();

$html =file_get_contents('http://localhost/tugas/modul/berkunjung/tabel.php');

    $pdf->writeHTML($html);
    $pdf->Output('DATA-TAMU.pdf', 'I');