<?php

include "../../config/func_koneksi.php";
include "../../config/func_sql.php";
include "../../config/func_konfigurasi.php";

if(isset($_GET['id'])){
	$absen = coc_sql("DEL", "tb_absen_data", "id_absen='$kode' AND id_mhs='$_GET[nim]' AND kel='$_GET[kel]'");
	if($absen){
		$nilai = coc_sql("DEL", "tb_nilai_data", "id_absen='$kode' AND id_mhs='$_GET[nim]'");
		header("location:../?act=abs&id=$kode");
	}else{
		header("location:../?act=abs&id=$kode&e=1");
	}	
}