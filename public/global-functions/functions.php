
<?php
function linha(array $semana)
{
    $linha = "<tr>";
    for($i = 0; $i < 7; $i++):
        if(array_key_exists($i, $semana)):
            $linha .= "<td>{$semana[$i]}</td>";
        else:
            $linha .= "<td></td>";
        endif;
    endfor;

    $linha .= "</tr>";
    return $linha;
}

function calendario()
{
    $calendario = '';
    $dia = 1;
    $semana = [];
    while($dia <= 31){
        array_push($semana, $dia);

        if(count($semana) == 7){
            $calendario .= linha($semana);
            $semana = [];
        }

        $dia++;
    }
    $calendario .= linha($semana);

    return $calendario;
}

function buscar_tarefas($conexao) : Array
{
    $query = 'select * from tarefas';    
    $result = mysqli_query($conexao, $query);

    $tarefas = [];

    while($tarefa = mysqli_fetch_assoc($result)):
        $tarefas[] = $tarefa;
    endwhile;

    return $tarefas;
}

function buscar_tarefa($conexao, int $id) : Array
{
    $query = 'select * from tarefas where id = '.$id;
    $result = mysqli_query($conexao, $query);
    $tarefa = mysqli_fetch_assoc($result);
    return $tarefa;
}

function salvar_tarefa($conexao, $tarefa)
{
    $campos = implode(', ', array_keys($tarefa));
    $query = "insert into tarefas ({$campos}) values (
        '{$tarefa['nome']}',
        '{$tarefa['descricao']}',
        '".data_translate($tarefa['prazo'], 2)."',
        {$tarefa['prioridade']},
        {$tarefa['concluida']}
        )";
    //echo $query;
    mysqli_query($conexao, $query);
    header('Location: index.php');
    die();
}

function editar_tarefa($conexao, $tarefa)
{
    $query = "update tarefas set nome='".$tarefa['nome']."',
            descricao='".$tarefa['descricao']."',
            prazo='".$tarefa['prazo']."',
            prioridade=".$tarefa['prioridade'].",
            concluida=".$tarefa['concluida']."
        where id=".$tarefa['id'];

    mysqli_query($conexao, $query);
    header('Location: index.php');
    die();
}

function remover_tarefa($conexao, int $id)
{
    $query = "delete from tarefas where id = {$id}";
    mysqli_query($conexao, $query);
    header('Location: index.php');
    die();
}

function remover_concluidas($conexao)
{
    $query = 'delete from tarefas where concluida = 1';
    mysqli_query($conexao, $query);
    header('Location: index.php');
    die();
}

function prioridade_translate($codigo) : string
{
    $prioridade = '';

    switch($codigo):
        case 1:
            $prioridade = 'Baixa';
            break;
        case 2:
            $prioridade = 'Média';
            break;
        case 3:
            $prioridade = 'Alta';
            break;
    endswitch;

    return $prioridade;
}

function data_translate($data, int $modo = 1)
{
    /*
    MODOS
    1 - visualizar (default)
    2 - salvar
    */
    $retorno = '';
    if($modo == 2):
        if($data == '')
            return '';

        $partes = explode('/', $data);

        if(count($partes) != 3):
            return $data;
        endif;

        $date = DateTime::createFromFormat('d/m/Y', $data);
        return $date->format('Y-m-d');
    elseif($modo == 1):
        if($data == '0000-00-00')
            $retorno = 'Indefinido';
        
        $partes = explode('-', $data);

        if(count($partes) != 3):
            return $data;
        endif;

        $date = DateTime::createFromFormat('Y-m-d', $data);
        return $date->format('d/m/Y');

    endif;
    
    return $retorno;
}

function validate($tarefa)
{
    $errors = [];
    if(array_key_exists('nome', $tarefa) && strlen($tarefa['nome']) > 0):
        $tarefa['nome'] = trim($tarefa['nome']);
        $tarefa['nome'] = strip_tags($tarefa['nome']);
        $tarefa['nome'] = htmlspecialchars($tarefa['nome']);
    else:
        $errors['errors'] = true; 
        $errors['erros_validacao']['nome'] = 'O campo nome é obirgatório';
    endif;

    if(array_key_exists('descricao', $tarefa)):
        $tarefa['nome'] = trim($tarefa['nome']);
        $tarefa['nome'] = strip_tags($tarefa['nome']);
        $tarefa['nome'] = htmlspecialchars($tarefa['nome']);
    endif;

    // if(array_key_exists('prazo', $tarefa)):
    //     if(validar_data($tarefa['prazo'])):
    //         $tarefa['prazo'] = data_translate($tarefa['prazo']);
    //     else:
    //         $errors['errors'] = true; 
    //         $errors['erros_validacao']['prazo'] = 'O prazo não é uma data válida';
    //     endif;
    // endif;

    return $errors;
}

function validar_data($data)
{
    $padrao = "/^[0-9]{1-2}\/[0-9]{1-2}\/[0-9]{4}$/";
    $result = preg_match($padrao, $data);

    if($result == 0)
        return false;
    
    $dados = explode('/', $data);

    $dia = $dados[0];
    $mes = $dados[1];
    $ano = $dados[2];
    
    $resultado = checkdate($mes, $dia, $ano);

    return $resultado;
}