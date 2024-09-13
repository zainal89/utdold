<?php
include "../../config/func_koneksi.php";
include "../../config/func_sql.php";

$bmn = $_POST['f_bmn'];
$nama = $_POST['f_nama'];
$merk = $_POST['f_merk'];
$type = $_POST['f_type'];
$ika = $_POST['f_ika'];

$cek = coc_count("tb_ika", "bmn = '$bmn'");
if($cek == 0){
	$dev = coc_sql("ADD", "tb_ika", "bmn='$bmn', nama='$nama', merk='$merk', type='$type', instruksi='$ika'");
	if($dev){
		header("location:../?act=device");
	}
}else{
	header("location:../?act=device&e=1");
}
