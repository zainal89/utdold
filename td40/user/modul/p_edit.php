<?php

session_start();
include "../../config/func_koneksi.php";
include "../../config/func_sql.php";


$hp = $_GET['fhp'];
$em = $_GET['femail'];

if(anti_inject($_GET['fpwd']) == ""){
	$upd = coc_sql("UPD", "tb_mhs", "hp='$hp', email='$em'", "id_mhs='$_SESSION[s_id_mhs]'");
	if($upd){
		header("location:../");
	}else{
		header("location:../?act=edit");
	}
}else{
	$pwd = md5(anti_inject($_GET['fpwd']));
	$upd = coc_sql("UPD", "tb_mhs", "hp='$hp', email='$em', pwd='$pwd'", "id_mhs='$_SESSION[s_id_mhs]'");
	if($upd){
		header("location:../logout.php");
	}else{
		header("location:../?act=edit");
	}
}


