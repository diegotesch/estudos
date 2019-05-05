<?php
session_start();


ini_set('display_errors', '1');
error_reporting(E_ALL);
require_once "global-functions/functions.php";
require_once "global-functions/connect.php";

$exibir_tabela = true;


$lista = buscar_tarefas($conn);

$tarefa = [
    'id' => 0,
    'nome' => array_key_exists('nome', $_POST) ? $_POST['nome'] : '',
    'descricao' => array_key_exists('descricao', $_POST) ? $_POST['descricao'] : '',
    'prazo' => array_key_exists('prazo', $_POST) ? data_translate($_POST['prazo']) : '',
    'prioridade' => array_key_exists('prioridade', $_POST) ? $_POST['prioridade'] : 1,
    'concluida' => array_key_exists('concluida', $_POST) ? $_POST['concluida'] : '',
];

if(!empty($_POST)):
    $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!isset($post['concluida'])):
        $post['concluida'] = '0';
    endif;

    $validate = validate($post);

    // var_dump($post, $validate);

    if(!$validate['errors']):
        salvar_tarefa($conn, $post);
    endif;
endif;





require 'template.php';
?>
