<?php
include "../../config/func_koneksi.php";
include "../../config/func_sql.php";
include "../../config/func_konfigurasi.php";

if($_GET['fid'] <> ""){
	$tdy  = date("d/m/Y");
	$jam  = date("H:i");
	$kode = anti_inject($_GET['fid']);
	$nim  = $_GET['fnim'];
	$data .= $tdy;

	$kuliah = coc_sql("SHOW", "tb_absen AS a", "a.id AS id, a.id_matkul AS kode", "a.id_matkul = '$kode'");

	$c_kuliah = $kuliah->num_rows;
	if($c_kuliah > 0){
		while ($r0 = $kuliah->fetch_array()) {
			$waktu = coc_sql("SHOW", "tb_absen_tgl AS a", "a.pertemuan AS meet", "a.id_absen=$r0[id] AND a.tanggal='$tdy'");
			$c_waktu = $waktu->num_rows;
			if($c_waktu > 0){
				while($r1 = $waktu->fetch_array()){
					$val_absen = coc_value("tb_absen_data", "absen", "id_absen=$r0[id] AND id_mhs='$nim' AND pertemuan=$r1[meet]");
					if($val_absen == NULL){
						$update = coc_sql("UPD", "tb_absen_data", "absen='$jam'", "id_absen=$r0[id] AND id_mhs='$nim' AND pertemuan=$r1[meet]");
						$idabsen = $r0['id'];
					}else{
						$idabsen = $r0['id'];
					}
					
				}	
				
				header("location:../?act=abs&id=".$idabsen);
			}else{
				header("location:../?act=qr&err=2");
			}
			
		}
		
	}else{
		header("location:../?act=qr&err=1");
	}
}

