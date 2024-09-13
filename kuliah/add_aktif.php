<?php
include "../config/func_koneksi.php";
include "../config/func_sql.php";

function tiket($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(isset($_POST['fNim'])){
    $nim = $_POST['fNim'];
    $nama = $_POST['fNama'];
    $prodi = $_POST['fProdi'];
    $email = $_POST['fEmail'];
    $smt = $_POST['fSemester'];
    $wa = $_POST['fWa'];
    $pa = explode("-", $_POST['fPa']);
    $ticket = tiket();
    $status = "Diajukan";
    coc_sql("ADD", "tb_aktif", "nim='$nim', ticket='$ticket', nama='$nama', prodi='$prodi', email='$email', smt='$smt', wa='$wa', pa='$pa[0]', nip='$pa[1]', status='$status' ");
    header("location:cek.php?t=".$ticket);
}


