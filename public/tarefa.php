<?php
session_start();
require_once './global-functions/connect.php';
require_once './global-functions/functions.php';

if(isset($_POST)):
    $tarefa_id = $_POST['tarefa_id'];

    if(!array_key_exists('anexo', $_FILES)):
        $tem_erros = true;
        $erros_validacao['anexo'] = 'Voce deve selecionar um arquivo para anexar';
    else:
        if(tratar_anexo($_FILES['anexo'])):
            $nome = $_FILES['anexo']['name'];
            $anexo = [
                'tarefa_id' => $tarefa_id,
                'nome' => substr($nome, 0, -4),
                'arquivo' => $nome,
            ];
        else:
            $tem_erros = true;
            $erros_validacao['anexo'] = 'Envie anexos nos formatos zip ou pdf';
        endif;
    endif;

    if(!$tem_erros):
        gravar_anexo($conn, $anxo);
    endif;

endif;

$tarefa = buscar_tarefa($conn, $_GET['id']);
$anexos = buscar_anexos($conn, $_GET['id']);

include 'template-tarefa.php';