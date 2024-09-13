<?php
include "../../config/func_koneksi.php";
include "../../config/func_sql.php";
include "../../config/func_konfigurasi.php";

if(isset($_GET['id'])){
	$absen = coc_sql("DEL", "tb_absen", "id='$kode'");
	if($absen){
		$absen_data = coc_sql("DEL", "tb_absen_data", "id_absen='$kode'");
		$absen_tgl  = coc_sql("DEL", "tb_absen_tgl", "id_absen='$kode'");
		$nilai  = coc_sql("DEL", "tb_nilai_data", "id_absen='$kode'");
	}

	if($absen){
		header("location:../?act=abs");
	}else{
		header("location:../?act=abs&e=1");
	}	
}