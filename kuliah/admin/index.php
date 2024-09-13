<?php
session_start();
include "../../config/func_koneksi.php";
include "../../config/func_sql.php";
include "../../config/func_konfigurasi.php";


if(empty($_SESSION['s_id_dosen'])){
	include "login.php";
}else{
	include "media.php";
}