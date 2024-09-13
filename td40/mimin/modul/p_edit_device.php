<?php
include "../../config/func_koneksi.php";
include "../../config/func_sql.php";

$bmn = $_POST['f_bmn'];
$nama = $_POST['f_nama'];
$merk = $_POST['f_merk'];
$type = $_POST['f_type'];
$ika = $_POST['f_ika'];

$dev = coc_sql("UPD", "tb_ika", "nama='$nama', merk='$merk', type='$type', instruksi='$ika'", "bmn='$bmn'");
if($dev){
	header("location:../?act=device");
}
