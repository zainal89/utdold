<?php

session_start();
$_SESSION['s_id_mhs'] = '';
unset($_SESSION['s_id_mhs']);
session_unset();
session_destroy();
header("location:index.php");