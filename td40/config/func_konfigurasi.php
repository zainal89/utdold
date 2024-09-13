<?php
	ini_set('display_errors',1); 
	date_default_timezone_set("Asia/Makassar");

	// PATH
	define("pathplugins","../plugins/");
	define("pathdist","../dist/");
	define("pathmodmhs", "../p_user/modul/mhs/");
	define("pathmoddosen", "../p_user/modul/dosen/");
	define("pathfotomhs", "../media/foto/mhs/");
	define("pathfotodosen", "../media/foto/dosen/");
	define("pathimgapp", "../media/foto/app/");

	define("pathqr", "../media/qr/");
	define("pathprint", "cetak/");

	@$kode = anti_inject($_GET['id']);
	@$aksi = $_GET['act'];
	@$pathmod = "modul/";


	@$user_pwd_default = md5('666666');
	@$dosen_pwd_default = md5('absen');

	@$user_pwd_def = '666666';
	@$dosen_pwd_default = md5('absen');
