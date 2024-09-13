<?php

include "../../config/func_koneksi.php";
include "../../config/func_sql.php";
include "../../config/func_konfigurasi.php";

if(isset($_GET['id'])){
	$reset = coc_sql("UPD", "tb_mhs", "pwd=md5('$user_pwd_def')", "nim='$kode'");
	if($reset){
		header("location:../?act=mhs");
	}else{
		header("location:../?act=mhs&id=$kode&e=1");
	}	
}