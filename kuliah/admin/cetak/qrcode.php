<?php
ob_start();
include "../../config/func_koneksi.php";
include "../../config/func_sql.php";
include "../../config/func_konfigurasi.php";
require "../../plugins/fpdf/fpdf.php";
include "../../plugins/qrphp/qrlib.php"; 

$uri = $_SERVER['REQUEST_URI'];
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
 $url = "https://" . $_SERVER['HTTP_HOST']."/user";


$pdf = new FPDF('P','mm','A5');
$pdf->AddPage();
$pdf->SetFont('Arial','B',12); 

	$data = coc_sql("SHOW", "tb_mk", "*", "kode_mk='$kode'");
	$r = $data->fetch_array();
	$add_img = "../".pathqr.$r['kode_mk'].".png";

	QRcode::png($r['kode_mk'], $add_img, QR_ECLEVEL_L, 10, 3); 
	$matkul  = $r['nama_mk'];
	$pdf->Line(10, 10, 10, 160);
	$pdf->Line(140, 10, 140, 160);
	$pdf->Line(10, 10, 140, 10);
	$pdf->Line(10, 160, 140, 160);

	$pdf->Image($add_img,25,12,100);
	$pdf->ln(100);
    $pdf->Cell(0, 10,$matkul, 0, 0, 'C');
    $pdf->ln(20);
    $pdf->Cell(0, 30,$url, 20, 0);
$filename = $matkul.".pdf";

$pdf->Output('D', $filename);
?>

