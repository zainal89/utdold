<?php

include "../../config/func_koneksi.php";
include "../../config/func_sql.php";
include "../../config/func_konfigurasi.php";

$id = $_POST['fid'];
$nim= $_POST['nim'];
$n1 = $_POST['n1'];
$n2 = $_POST['n2'];
$n3 = $_POST['n3'];
$n4 = $_POST['n4'];
$n5 = $_POST['n5'];

for($c=0;$c<count($nim);$c++){
	coc_sql("UPD", "tb_nilai_data", "n1='$n1[$c]', n2='$n2[$c]', n3='$n3[$c]', n4='$n4[$c]', n5='$n5[$c]'", "id_absen='$id' AND id_mhs='$nim[$c]'");
}

header("location:../?act=skor&id=".$id);