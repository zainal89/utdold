<?php

function anti_inject($data){
	@$filter_sql = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	@$filter_sql->$mysqli->real_escape_string;
	return $filter_sql;
}

function coc_sql($mode, $table, $field, $where=NULL, $order=NULL, $group=NULL) {
	global $mysqli;
	switch($mode) {
		case 'SHOW':
			if (empty($order) && empty($group)) {
				$query = $mysqli->query("SELECT $field FROM $table WHERE $where");
			} elseif (empty($group)) {
				$query = $mysqli->query("SELECT $field FROM $table WHERE $where ORDER BY $order");
			} else {
				$query = $mysqli->query("SELECT $field FROM $table WHERE $where GROUP BY $group ORDER BY $order");
			}
			break;
			
		case 'DISTINCT':
			if (empty($order) && empty($group)) {
				$query = $mysqli->query("SELECT DISTINCT $field FROM $table WHERE $where");
			} elseif (empty($group)) {
				$query = $mysqli->query("SELECT DISTINCT $field FROM $table WHERE $where ORDER BY $order");
			} else {
				$query = $mysqli->query("SELECT DISTINCT $field FROM $table WHERE $where GROUP BY $group ORDER BY $order");
			}
			break;
			
		case 'ADD':
			$query = $mysqli->query("INSERT INTO $table SET $field");
			break;
		case 'UPD':
			$query = $mysqli->query("UPDATE $table SET $field WHERE $where");
			break;
		case 'DEL':
			$query = $mysqli->query("DELETE FROM $table WHERE $field");
			break;
		}
	return $query;
}


function coc_value($table, $field, $where){
	$r = coc_sql("SHOW","$table","$field","1=1 AND $where","$field DESC LIMIT 1")->fetch_array();
	return $r[0];
}

function coc_count($table, $where){
	$r = coc_sql("SHOW","$table","*","$where")->num_rows;
	return $r;
}

function huruf($nilai){
	$data = coc_sql("SHOW", "z_nilai", "*", "1=1");
	while($r = $data->fetch_array()){
		if($nilai < $r['max'] AND $nilai >= $r['min']){
			return $r['huruf'];
		}
	}
}

function con_waktu($jam){
	$d = explode(":", $jam);
	$waktu = ($d[0]*3600) + ($d[1]*60);
	return $waktu; 
}

function kehadiran($absen, $batas){
	$datang = con_waktu($absen) > con_waktu($batas) ? false : true;
	return $datang;
}

function dec($nilai){
	$angka = number_format($nilai, 2, ".", ",");
	return $angka;
}

function shari($d){
	$id_hari = array(
	    'Mon' => 'Senin',
	    'Tue' => 'Selasa',
	    'Wed' => 'Rabu',
		'Thu' => 'Kamis',
		'Fri' => 'Jumat',
		'Sat' => 'Sabtu',
		'Sun' => 'Ahad'
	);
	return $id_hari[$d];
}

function idbulan($m){
	$id_bulan = array(
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'
	);
	return $id_bulan[$m];
}

function idfulltoday(){
	$hari = date('d');
	$dt = date('D');
	$bulan = date('m');
	$tahun = date('Y');
	$waktu = shari($dt).", ".$hari." ".idbulan($bulan)." ".$tahun;
	return $waktu;
}

function tglabsen($tgl){
	$arr = explode("/", $tgl); 
	return $arr[0]."/".$arr[1];
}

function jk($i){
	$arr = array(
		'L' => 'Laki-laki',
		'P' => 'Perempuan'
	);
	return $arr[$i];
}