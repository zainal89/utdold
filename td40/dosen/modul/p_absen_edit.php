<?php

include "../../config/func_koneksi.php";
include "../../config/func_sql.php";
include "../../config/func_konfigurasi.php";

$id  = $_POST['fid'];
$nim = $_POST['fnim'];
$mk  = $_POST['fmk'];
$c=0;
foreach ($_POST['fp'] as $meet) {
	$c++;
	$edit = coc_sql("UPD", "tb_absen_data", "absen='$meet'", "id_absen='$id' AND id_mhs='$nim' AND pertemuan='$c'");
}

if($edit){
	header("location:../?act=abs&id=".$id);
}
