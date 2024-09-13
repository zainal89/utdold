<?php

include "../../config/func_koneksi.php";
include "../../config/func_sql.php";
include "../../config/func_konfigurasi.php";


echo $kel = $_GET['fkel'];
echo "<br>";
echo $kode;
echo "<br>";
if(isset($_GET['mhs'])){
	foreach ($_GET['mhs'] as $key => $mhs) {
		echo $mhs."<br>";	
	}
}

echo $meet = 0;
foreach($_GET['p'] as $key => $p){
	$meet++;
	$update = coc_sql("UPD", "tb_absen_tgl", "tanggal='$p'", "id_absen='$kode' AND kel='$kel' AND pertemuan='$meet'");
	if($update){
		echo "ok";
	}else{
		echo "no";
	}
}