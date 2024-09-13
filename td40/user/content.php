<?php

if (!defined('db_dbase')) exit ('Not Allowed');

switch ($aksi) {
	case ''    : include $pathmod."dboard.php";break;
	case 'db'  : include $pathmod."dboard.php";break;
	case 'abs' : include $pathmod."absen.php";break;
	case 'rek' : include $pathmod."rekap.php";break;
	case 'edit': include $pathmod."edit.php";break;
	case 'qr'  : include $pathmod."scanner.php";break;
	case 'lo'  : include "logout.php";break;

	
	default:
		include "error.php";break;
}