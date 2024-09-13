<?php

session_start();
include "../../config/func_koneksi.php";
include "../../config/func_sql.php";

$hp = $_GET['fhp'];
$em = $_GET['femail'];
$pwd = md5(anti_inject($_GET['fpwd']));
if($pwd == "41d8cd98f00b204e9800998ecf8427e"){
	$upd = coc_sql("UPD", "tb_dosen", "hp='$hp', email='$em'", "id_dosen='$_SESSION[s_id_dosen]'");
}else{
	$upd = coc_sql("UPD", "tb_dosen", "hp='$hp', email='$em', pwd='$pwd'", "id_dosen='$_SESSION[s_id_dosen]'");
}


if($upd){
	header("location:../");
}else{
	header("location:../?act=edit");
}

