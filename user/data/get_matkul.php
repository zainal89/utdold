<?php
include "../../config/func_koneksi.php";
include "../../config/func_sql.php";
include "../../config/func_konfigurasi.php";

if($_POST['fid'] <> ""){
	$data = "";
	$tdy  = date("d/m/Y");
	$jam  = date("H:i");
	$kode = anti_inject($_POST['fid']);
	$nim  = $_POST['fnim'];
	$data .= $tdy;

	$kuliah = coc_sql("SHOW", "tb_absen AS a", "a.id AS id, a.id_matkul AS kode", "a.id_matkul = '$kode'");

	$c_kuliah = $kuliah->num_rows;
	if($c_kuliah > 0){
		while ($r0 = $kuliah->fetch_array()) {
			$waktu = coc_sql("SHOW", "tb_absen_tgl AS a", "a.pertemuan AS meet", "a.id_absen=$r0[id] AND a.tanggal='$tdy'");
			$c_waktu = $waktu->num_rows;
			if($c_waktu > 0){
				while($r1 = $waktu->fetch_array()){
					$update = coc_sql("UPD", "tb_absen_data", "absen='$jam'", "id_absen=$r0[id] AND id_mhs='$nim' AND pertemuan=$r1[meet]");
				}	
			}
			
		}
	}else{
		$data .= "<p><strong>Data Absen Tidak Di Temukan</strong></p>";
	}
}

$data .= $c_kuliah;
$callback = array('data_absen'=>$data);
echo json_encode($callback);
