<?php
// ob_start();
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

	$data = coc_sql("SHOW", "tb_ika", "*", "id='$kode'");
	$r = $data->fetch_array();
	$add_img = "../".pathqr.ucwords($r['bmn']).".png";

	QRcode::png(ucwords($r['bmn']), $add_img, QR_ECLEVEL_L, 10, 3); 
	$alat  = ucwords($r['nama']);
//  	$pdf->Line(2, 2, 2, 32);
//  	$pdf->Line(2, 2, 32, 2);
//  	$pdf->Line(2, 32, 2, 2);
//  	$pdf->Line(32, 2, 2, 2);

	$pdf->Image($add_img,10,10,50);
	$pdf->ln(100);
   // $pdf->Cell(0, 2,$alat, 0, 0, 'C');
    // $pdf->ln(20);
    // $pdf->Cell(0, 30,$url, 20, 0);
$filename = $alat.".pdf";

$pdf->Output('D', $filename);
?>

