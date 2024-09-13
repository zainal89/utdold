<?php
session_start();
include "../config/func_koneksi.php";
include "../config/func_sql.php";
include "../config/func_konfigurasi.php";

$user = anti_inject($_POST['fuser']);
$pwd = md5($_POST['fpwd']);

if(!empty($nim) OR !empty($pwd)){
	$log_user = coc_sql("SHOW", "tb_mimin", "*", "email='$user' AND pwd='$pwd'");
	$found_user = $log_user->num_rows;

	if($found_user == 1){
		$r = $log_user->fetch_array();
		$_SESSION['s_id_mimin'] = $r['id'];
		if($pwd == $user_pwd_default) {
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