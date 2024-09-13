<?php

if (!defined('db_dbase')) exit ('Not Allowed');

switch ($aksi) {
	case ''    : include $pathmod."dboard.php";break;
	case 'db'    : include $pathmod."dboard.php";break;
	case 'edit': include $pathmod."edit.php";break;
	case 'his' : include $pathmod."history.php";break;
	case 'mhs': include $pathmod."mhs.php";break;
	case 'device' : include $pathmod."alat.php";break;
	case 'add' : include $pathmod."add_device.php";break;
	case 'edd' : include $pathmod."edit_device.php";break;
	case 'dosen' : include $pathmod."dosen.php";break;
	case 'lo'  : include "logout.php";break;
	
	default:
		include "error.php";break;
}