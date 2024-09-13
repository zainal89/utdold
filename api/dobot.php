<?php
include_once "../config/func_koneksi.php";
include_once "../config/func_sql.php";

if(isset($_GET['api']) && isset($_GET['color'])){
    $api_id = $_GET['api'];
    $color = $_GET['color'];
   if(!empty($api_id) && !empty($color)){
        $log_user = coc_sql("SHOW", "tb_dobot_api", "api_id", "api_id='$api_id'");
	    $found_user = $log_user->num_rows; 
	    if($found_user == 1){
	        $upd = coc_sql("UPD", "tb_dobot", "value = value+1", "name='$color'");
	        $upd = coc_sql("UPD", "tb_dobot_api", "hit = hit+1", "api_id='$api_id'");
	    }
    }
   
}