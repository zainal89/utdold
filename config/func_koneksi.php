<?php

define("db_host", "localhost"); 
// define("db_user", "zainal_abs"); 
// define("db_pwd", "Ospabsen22");
// define("db_dbase", "zainal_absen");

define("db_user", "root"); 
define("db_pwd", "");
define("db_dbase", "db_utdold");

// define("db_user", "takt3736_osp"); 
// define("db_pwd", "Absen???21");
// define("db_dbase", "takt3736_osp");

$mysqli = new mysqli(db_host, db_user, db_pwd, db_dbase);
if ($mysqli->connect_error){ 
	trigger_error('Koneksi Gagal !!!: ' . $mysqli->connect_error, E_USER_ERROR);
}