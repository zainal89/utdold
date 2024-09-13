<?php
include "../../config/func_koneksi.php";
include "../../config/func_sql.php";

if(isset($_POST['fid'])){
	$kode = $_POST['fid'];
	$data = coc_sql("SHOW", "tb_absen", "*", "id=$kode");
	$r = $data->fetch_array();
	$mhs = $_POST['mhs'];
	$meet = $_POST['p'];
	$kel = $_POST['fkelompok'];
	$jam = $_POST['fjam'];
	$pertemuan = 0;

	if($jam != ""){coc_sql("UPD", "tb_absen", "jam='$jam'", "id='$kode'");}
	foreach($meet as $key => $tgl){
		$pertemuan++;
		if($tgl != ""){
			
			coc_sql("UPD", "tb_absen_tgl", "tanggal='$tgl'", "id_absen='$kode' AND kel='$kel' AND pertemuan='$pertemuan'");
		}
	}

	foreach($mhs as $key => $mahasiswa){
		for($c=1;$c<=$r['pertemuan'];$c++){
			coc_sql("ADD", "tb_absen_data", "id_absen='$kode', kel='$kel', pertemuan='$c', id_mhs='$mahasiswa'");
		}
		coc_sql("ADD", "tb_nilai_data", "id_absen='$kode', id_mhs='$mahasiswa'");
	}
	header("location:../?act=abs&id=$kode");
}


