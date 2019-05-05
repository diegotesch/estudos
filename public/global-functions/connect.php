<?php

$db_server = 'localhost';
$db_user = 'root';
$db_name = 'php_estudos';
$db_pass = '';

try{
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
}catch(Exception $e){
    echo "Problemas ao conectar-se ao banco: {$e->getMessage()}";
    echo mysqli_connect_error();
    die();
}


