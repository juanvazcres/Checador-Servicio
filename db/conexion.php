<?php

$server = 'mysql.hostinger.es';
$user = 'u663084877_ss';
$password = 'AgilesISC';
$database = 'u663084877_ss';

$linkConexion =  mysqli_connect($server,$user,$password,$database) or die("Error " . mysqli_error($linkConexion)); 

?>