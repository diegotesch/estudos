<?php
session_start();

ini_set('display_errors', '1');
error_reporting(E_ALL);
require_once "global-functions/functions.php";
require_once "global-functions/connect.php";

$exibir_tabela = false;

if(isset($_GET['id'])):
    $tarefa = buscar_tarefa($conn, $_GET['id']);
endif;

if(!empty($_POST)):
    $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!isset($post['concluida'])):
        $post['concluida'] = '0';
    endif;

    $validate = validate($post);

    // var_dump($post, $validate);

    if(!$validate['errors']):
        editar_tarefa($conn, $post);
    endif;
endif;

require 'template.php';