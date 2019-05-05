<?php
session_start();

ini_set('display_errors', '1');
error_reporting(E_ALL);
require_once "global-functions/functions.php";
require_once "global-functions/connect.php";

$exibir_tabela = false;

if(isset($_GET['id'])):
    $tarefa = buscar_tarefa($conn, $_GET['id']);

    if(!isset($tarefa['concluida'])):
        $tarefa['concluida'] = '0';
    endif;
    unset($tarefa['id']);
endif;

salvar_tarefa($conn, $tarefa);