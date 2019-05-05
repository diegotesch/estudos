<?php
session_start();

ini_set('display_errors', '1');
error_reporting(E_ALL);
require_once "global-functions/functions.php";
require_once "global-functions/connect.php";

$anexo = buscar_anexo($conn, $_GET['id']);
remover_anexo($conn, $anexo['id']);
unlink('anexos/'.$anexo['arquivo']);

header('Location: tarefa.php?id='.$anexo['tarefa_id']);
