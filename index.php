<?php
$uri = 'https://';
$uri .= $_SERVER['HTTP_HOST'];
header('Location: '.$uri.'/user/');
exit;
