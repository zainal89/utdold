<?php

session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Makassar");
set_time_limit(360);
ini_set('memory_limit', '-1');


require "../../plugins/PHPExcel/vendor/autoload.php";
include "../../config/func_koneksi.php";
include "../../config/func_sql.php";
include "../../config/func_konfigurasi.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$ss = new Spreadsheet(); // Create new Spreadsheet object
$ss->getProperties()->setCreator('COC_Design')
    ->setLastModifiedBy('COC_Design')
    ->setTitle('Nilai')
    ->setSubject('Office XLSX')
    ->setDescription('Nilai')
    ->setKeywords('Nilai')
    ->setCategory('Nilai');



if ((empty($_SESSION['s_id_dosen']))){
	 echo "<script>window.close();</script>";
}else{

	$scol = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    	],
	];


	$scoll = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
		'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
	    ],
	];

	$scolr = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
		'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
	    ],
	];

	$tabel = [
    'borders' => [
        'top'    => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
		'right'  => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
		'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
		'left'   => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
    	],
	];

	
	$id = $_GET['id'] == "" ? "ALL" : $_GET['id'];
	$absen = coc_sql("SHOW", "
		tb_absen AS a 
		LEFT JOIN tb_kelas AS b ON a.id_kelas = b.id 
		LEFT JOIN tb_mk AS c ON a.id_matkul = c.kode_mk 
		LEFT JOIN tb_dosen AS d ON a.id_dosen = d.id_dosen 
		",
		"b.kelas AS kelas, c.nama_mk AS matkul, d.nama AS dosen",
		"a.id=$id");
       	$r = $absen->fetch_array();
    $nf = "Nilai ".$r['kelas']."-".$r['matkul'].".xls";
	$ss->setActiveSheetIndex(0)->setCellValue('A1', 'NILAI MATA KULIAH');
	$ss->getActiveSheet()->mergeCells('A1:J1');
	$ss->getActiveSheet()->getStyle('A1')->getFont()->setUnderline(TRUE);
	$ss->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
	$ss->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); 
	$ss->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    
   
	$t = array("Mata Kuliah", "Dosen", "Kelas");
	$v = array($r['matkul'], $r['dosen'], $r['kelas']);

	for($c=0;$c<count($t);$c++){
		$d = $c + 3;
		$ss->setActiveSheetIndex(0)
			->setCellValue('A'.$d, $t[$c])
			->setCellValue('C'.$d, ': '.$v[$c]);
		$ss->getActiveSheet()->mergeCells('A'.$d.':B'.$d);
	}

	$t1 = array("NO", "NIM", "NAMA", "Nilai", "Kehadiran", "Tugas Awal", "Praktek", "Laporan", "Ujian", "Angka", "Huruf", "AK", "AL", "AM", "AN", "AO");
	$v1 = array("A", "B", "C", "D", "D", "E", "F", "G", "H", "I", "J", "AK", "AL", "AM", "AN", "AO");
	$s1 = array(5, 12, 35, 8,12, 12, 8, 8, 8, 8, 8, 0, 0, 0, 0, 0);

	$nh = 7;
	$mg = $nh + 1;
	$ss->getActiveSheet()->mergeCells('D'.$nh.':H'.$nh);

	for($c=0;$c<count($t1);$c++){

		$d = $c<4 || $c>8 ? $nh : $mg;
		$ss->setActiveSheetIndex(0)->setCellValue($v1[$c].''.$d, $t1[$c]);
		$ss->getActiveSheet()->getColumnDimension($v1[$c])->setWidth($s1[$c]); 
		if($c<3 || $c>8){
			$ss->getActiveSheet()->mergeCells($v1[$c].''.$nh.':'.$v1[$c].''.$mg);		
		}
		for($c1=$nh;$c1<$mg+1;$c1++){
			$ss->getActiveSheet()
				->getStyle($v1[$c].''.$c1, $t1[$c])
				->applyFromArray($scol)
				->applyFromArray($tabel);
		}
	}

	$ss->setActiveSheetIndex(0)
		->setCellValue('AK1', '0')
		->setCellValue('AL1', 'E')
		->setCellValue('AK2', '41')
		->setCellValue('AL2', 'D')
		->setCellValue('AK3', '50')
		->setCellValue('AL3', 'C-')
		->setCellValue('AK4', '56')
		->setCellValue('AL4', 'C')
		->setCellValue('AK5', '65')
		->setCellValue('AL5', 'B-')
		->setCellValue('AK6', '71')
		->setCellValue('AL6', 'B')
		->setCellValue('AK7', '75')
		->setCellValue('AL7', 'A-')
		->setCellValue('AK8', '86')
		->setCellValue('AL8', 'A');


	$qry = coc_sql("SHOW", 
			"tb_nilai_data AS a LEFT JOIN tb_mhs AS b ON a.id_mhs=b.nim",
			"a.id_mhs AS nim, b.nama AS mhs, a.n1 AS absen, a.n2 AS awal, a.n3 AS praktik, a.n4 AS lapor, a.n5 AS final",
			"a.id_absen=$kode", "a.id_mhs"
			);
	$no = 0;
	while($r = $qry->fetch_array()){
		$numrow = $no + 9; //mulai baris
		$no++;
		$absen = $r['absen'] == NULL ? 0 : $r['absen'];
		$awal = $r['awal'] == NULL ? 0 : $r['awal'];
		$praktik = $r['praktik'] == NULL ? 0 : $r['praktik'];
		$lapor = $r['lapor'] == NULL ? 0 : $r['lapor'];
		$final = $r['final'] == NULL ? 0 : $r['final'];
		$final = $absen < 80 ? ($absen*$final)/100 : $final;
		$ang = "=(D".$numrow."*0.1)+(E".$numrow."*0.10)+(F".$numrow."*0.4)+(G".$numrow."*0.2)+(H".$numrow."*0.2)";
		$hur = "=VLOOKUP(I".$numrow.", \$AK\$1:\$AL\$8, 2)";

		$v = array($no, $r['nim'], strtoupper($r['mhs']), $absen, $awal, $praktik, $lapor, $final, $ang, $hur);
		$h = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J");

		for($c=0;$c<count($v);$c++){
			$ss->setActiveSheetIndex(0)->setCellValue($h[$c].''.$numrow, $v[$c]);
			if($c==2){
			$ss->getActiveSheet()->getStyle($h[$c].''.$numrow)
				->applyFromArray($scoll)
				->applyFromArray($tabel);
			}
			else if($c > 2 && $c < 9){
			$ss->getActiveSheet()->getStyle($h[$c].''.$numrow)->getNumberFormat()->setFormatCode('[Blue][=100]#.00;[Red][=0]0.00;#.00');
			$ss->getActiveSheet()->getStyle($h[$c].''.$numrow)
				->applyFromArray($scolr)
				->applyFromArray($tabel);

			}else{
			$ss->getActiveSheet()->getStyle($h[$c].''.$numrow)
				->applyFromArray($scol)
				->applyFromArray($tabel);
			}
		}
	}

	// Rename worksheet
	$ss->getActiveSheet()->setTitle('Nilai');
	$ss->setActiveSheetIndex(0);

	// Redirect output to a client’s web browser (Xls)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$nf.'"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header('Pragma: public'); // HTTP/1.0

	$writer = IOFactory::createWriter($ss, 'Xls');
	$writer->save('php://output');
	exit;
}

?>