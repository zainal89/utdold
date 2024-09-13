<?php
include "../config/func_koneksi.php";
include "../config/func_sql.php";
// include "../config/func_konfigurasi.php";

if(isset($_REQUEST['query'])){
    
   $query = $_REQUEST['query'];
   $log_user = coc_sql("SHOW", "tb_dosen", "nama, nip", "nama LIKE '%$query%' LIMIT 10");
   if($log_user->num_rows > 0){
    while($row = $log_user->fetch_assoc()){
     echo "<p>" . $row['nama'] ." - ". $row['nip'] . "</p>";
    }
   }

}
