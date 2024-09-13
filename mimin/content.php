<?php

if (!defined('db_dbase')) exit ('Not Allowed');

switch ($aksi) {
	case ''    : include $pathmod."dboard.php";break;
	case 'edit': include $pathmod."edit.php";break;
	case 'mhs': include $pathmod."mhs.php";break;
	case 'abs' : include $pathmod."absen.php";break;
	case 'ask' : include $pathmod."tanya.php";break;
	case 'upd' : include $pathmod."dobot.php";break;
	case 'lo'  : include "logout.php";break;
	
	default:
		include "error.php";break;
}