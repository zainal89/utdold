<?php
include "../../config/func_koneksi.php";
include "../../config/func_sql.php";

$periode = $_POST['fperiode'];
$prodi = $_POST['fprodi'];
$matkul = $_POST['fmatkul'];
$dosen = $_POST['fdosen'];
$kelas = $_POST['fkelas'];
$kelompok = $_POST['fkelompok'];
$pertemuan = $_POST['fpertemuan'];

$cek = coc_count("tb_absen", "id_kelas='$kelas' AND id_periode='$periode' AND id_matkul='$matkul' AND id_dosen='$dosen' AND id_prodi='$prodi'");
if($cek == 0){
	$absen = coc_sql("ADD", "tb_absen", "id_kelas='$kelas', id_periode='$periode', id_matkul='$matkul', id_dosen='$dosen', id_prodi='$prodi', kelompok=$kelompok, pertemuan=$pertemuan");
	if($absen){
		$id_absen = coc_value("tb_absen", "id", "id_periode='$periode' AND id_matkul='$matkul' AND id_kelas='$kelas' AND id_prodi='$prodi'");
		for($k=1;$k<=$kelompok;$k++){
			for($meet=1;$meet<=$pertemuan;$meet++){
				coc_sql("ADD", "tb_absen_tgl", "id_absen=$id_absen, kel=$k, pertemuan=$meet");
			}
		}
		header("location:../?act=abs");
	}
}else{
	header("location:../?act=abs&e=1");
}
