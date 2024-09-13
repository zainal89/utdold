<?php
session_start();
include "../config/func_koneksi.php";
include "../config/func_sql.php";
include "../config/func_konfigurasi.php";

$nim = anti_inject($_POST['fuser']);
$pwd = md5($_POST['fpwd']);

if(!empty($nim) OR !empty($pwd)){
	$log_user = coc_sql("SHOW", "tb_mhs", "*", "nim='$nim' AND pwd='$pwd'");
	$found_user = $log_user->num_rows;

	if($found_user == 1){
		$r = $log_user->fetch_array();
		$_SESSION['s_id_mhs'] = $r['id_mhs'];
		$_SESSION['d_nim_mhs'] = $r['nim'];
 		if($r['id_kartu'] == Null) {
 			header("location:index.php?act=edit");
 		}else{
			header('location:index.php');
 		}
	}else{
		header('location:index.php?e=t');
	}
}else{
	header('location:index.php?e=t');
}