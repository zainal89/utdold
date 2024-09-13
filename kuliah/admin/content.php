<?php

if (!defined('db_dbase')) exit ('Not Allowed');

switch ($aksi) {
	case ''    : include $pathmod."dboard.php";break;
	case 'edit': include $pathmod."edit.php";break;
	case 'list' : include $pathmod."list.php";break;
	case 'valid' : include $pathmod."valid.php";break;
	case 'lo'  : include "logout.php";break;
	
	default:
		include "error.php";break;
}