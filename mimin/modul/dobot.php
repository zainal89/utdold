<?php
include "../config/func_koneksi.php";
include_once "../config/func_sql.php";

echo "hallo";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $val = $_GET['val'];
    
    // Query untuk mengupdate data
    $sql = "UPDATE tb_dobot SET value = '$new_value' WHERE id = $id";
    $upd = coc_sql("UPD", "tb_dobot", "value = $val", "id='$id'");
    // if ($conn->query($sql) === TRUE) {
    //     echo "Record updated successfully";
    // } else {
    //     echo "Error updating record: " . $conn->error;
    // }
}