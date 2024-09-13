<?php
include "../config/func_koneksi.php";
include "../config/func_sql.php";
// include "../config/func_konfigurasi.php";

if(isset($_GET['nim'])){
    
   $nim = $_GET['nim'];
   $log_user = coc_sql("SHOW", "tb_mhs", "*", "nim='$nim'");
   $result = $log_user->fetch_assoc();
   echo json_encode($result);
}
