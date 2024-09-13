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
		"a.pertemuan AS meet, a.kelompok AS kelompok, b.kelas AS kelas, c.nama_mk AS matkul, d.nama AS dosen",
		"a.id=$id");
       	$r = $absen->fetch_array();

    $nf = "Absen ".$r['kelas']."-".$r['matkul'].".xls";

    $meet  = $r['meet'];
    $mc = $meet == 24 ? "A1:AE1" : "A1:W1";
	$ss->setActiveSheetIndex(0)->setCellValue('A1', 'ABSENSI PERKULIAHAN');
	$ss->getActiveSheet()->mergeCells($mc);
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

	if($meet == 24){
		$t1 = array("NO", "NIM", "NAMA", "P1", "P2", "P3", "P4", "P5", "P6", "P7", "P8", "P9", "P10", "P11", "P12", "P13", "P14", "P15", "P16", "P17", "P18", "P19", "P20", "P21", "P22", "P23", "P24", "H", "S", "I", "A");		
	}else{
		$t1 = array("NO", "NIM", "NAMA", "P1", "P2", "P3", "P4", "P5", "P6", "P7", "P8", "P9", "P10", "P11", "P12", "P13", "P14", "P15", "P16", "H", "S", "I", "A");
	}

	$v1 = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE");
	$s1 = array(5, 12, 35, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12);

	$nh = 7;

	for($c=0;$c<count($t1);$c++){
		$ss->setActiveSheetIndex(0)->setCellValue($v1[$c].''.$nh, $t1[$c]);
		$ss->getActiveSheet()->getColumnDimension($v1[$c])->setWidth($s1[$c]);
		$ss->getActiveSheet()->getStyle($v1[$c].''.$nh)->getFont()->setBold(TRUE); 
		$ss->getActiveSheet()
				->getStyle($v1[$c].''.$nh)
				->applyFromArray($scol)
				->applyFromArray($tabel);
	}

	$nh++;
	$num = 1;
	for($tc=1;$tc<=$r['kelompok'];$tc++){
      
      $ff = 2;
      $ss->setActiveSheetIndex(0)->setCellValue($v1['0'].''.$nh, 'KELOMPOK '.$tc);
      for($c=0;$c<3;$c++){
      	$ss->getActiveSheet()->getStyle($v1[$c].''.$nh)->getFont()->setBold(TRUE);
      	$ss->getActiveSheet()
			->getStyle($v1[$c].''.$nh)
			->applyFromArray($scol)
			->applyFromArray($tabel);
      }
      $ss->getActiveSheet()->mergeCells('A'.$nh.':C'.$nh);
      $tgl = coc_sql("SHOW", "tb_absen_tgl", "*", "id_absen='$kode' AND kel='$tc'");
          while($r3 = $tgl->fetch_array()){
          	$ff++;
          	$ss->setActiveSheetIndex(0)->setCellValue($v1[$ff].''.($nh), $r3['tanggal']);
          	$ss->getActiveSheet()->getStyle($v1[$ff].''.$nh)->getFont()->setBold(TRUE);
          	$ss->getActiveSheet()
				->getStyle($v1[$ff].''.$nh)
				->applyFromArray($scol)
				->applyFromArray($tabel);
          }
      
      $absen_mhs = coc_sql("SHOW", 
            "tb_absen_data AS a LEFT JOIN tb_mhs AS b ON a.id_mhs = b.nim", 
            "a.id_mhs AS nim, b.nama AS nama", 
            "a.id_absen='$kode' AND a.kel='$tc'", 
            "a.id_mhs", 
            "a.id_mhs ASC");
         while($r4 = $absen_mhs->fetch_array()){
         	$nh++;
         	$arr = array($num, $r4['nim'], strtoupper($r4['nama']));
         	for($dd=0;$dd<count($arr);$dd++){
         		$ss->setActiveSheetIndex(0)->setCellValue($v1[$dd].''.$nh, $arr[$dd]);
         		$ss->getActiveSheet()
					->getStyle($v1[$dd].''.$nh)
					->applyFromArray($scoll)
					->applyFromArray($tabel);
         	}
         	$absen_cek = coc_sql("SHOW", "tb_absen_data", "absen", "id_absen='$kode' AND id_mhs='$r4[nim]'", "pertemuan ASC");
         		$c_arr = 0;
         		$h = 0;
         		$s = 0;
         		$i = 0;
         		$a = 0;
              while($r5 = $absen_cek->fetch_array()){
                switch($r5['absen']){
                	case ''  : $absensi = "A";$a++;break;
                	case 'S' : $absensi = "S";$s++;break;
                	case 'I' : $absensi = "I";$i++;break;
                	case 'A' : $absensi = "A";$a++;break;
                	default  : $absensi = "H";$h++;

                }
                $arr_data[$c_arr] = $absensi;
                $c_arr++;
              }
              for($darr=0;$darr<count($arr_data);$darr++){
				$col = $darr + 3;
				$ss->setActiveSheetIndex(0)->setCellValue($v1[$col].''.$nh, $arr_data[$darr]);
				$ss->getActiveSheet()
					->getStyle($v1[$col].''.$nh)
					->applyFromArray($scol)
					->applyFromArray($tabel);
				}
				$sum = array($h, $s, $i, $a);
				for($c=0;$c<count($sum);$c++){
					$fsum = $c + $col + 1;
					$ss->setActiveSheetIndex(0)->setCellValue($v1[$fsum].''.$nh, $sum[$c]);
					$ss->getActiveSheet()
						->getStyle($v1[$fsum].''.$nh)
						->applyFromArray($scol)
						->applyFromArray($tabel);

				}
         	$num++;
         }
        $nh++;
    }


	// Rename worksheet
	$ss->getActiveSheet()->setTitle('Absen');
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