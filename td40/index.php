<?php
$uri = 'https://';
$uri .= $_SERVER['HTTP_HOST'];
header('Location: '.$uri.'/td40/user/');
exit;
