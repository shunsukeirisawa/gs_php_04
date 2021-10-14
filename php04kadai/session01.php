<?php


session_start();

$sid = session_id();


$_SESSION['name'] = 'ふくしま';
$_SESSION['age'] = 16;
$_SESSION['love'] = 'ラーメン二郎';