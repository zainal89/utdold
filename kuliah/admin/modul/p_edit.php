<?php

session_start();
include "../../config/func_koneksi.php";
include "../../config/func_sql.php";

$hp = $_GET['fhp'];
$em = $_GET['femail'];

if(anti_inject($_GET['fpwd']) == ""){
	$upd = coc_sql("UPD", "tb_dosen", "hp='$hp', email='$em'", "id_dosen='$_SESSION[s_id_dosen]'");
}else{
	$pwd = md5(anti_inject($_GET['fpwd']));	
	$upd = coc_sql("UPD", "tb_dosen", "hp='$hp', email='$em', pwd='$pwd'", "id_dosen='$_SESSION[s_id_dosen]'");
}


if($upd){
	header("location:../");
}else{
	header("location:../?act=edit");
}

