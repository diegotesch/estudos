<?php
session_start();

if(!empty($_POST)):
    $post = filter_input_array(INPUT_POST, [
        'nome' => FILTER_SANITIZE_STRING,
        'telefone' => FILTER_SANITIZE_NUMBER_INT,
        'email' => FILTER_SANITIZE_EMAIL
    ]);
    $_SESSION['contatos'][] = $post;
endif;

$lista = [];

if(isset($_SESSION['contatos'])){
    $lista = $_SESSION['contatos'];
}

ini_set('display_errors', '1');
error_reporting(E_ALL);
require_once "global-functions/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estudos PHP</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
</head>
<body>
    


    <div class="main">
        <div class="container">
            <h1>Gerenciador de Contatos</h1>

            <form class="form" action="" method="post">
                <fieldset class="form-group">
                    <legend>Nova Contato</legend>
                </fieldset>

                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" class="form-control" name="nome" />
                </div>
                <div class="form-group">
                    <label>Telefone:</label>
                    <input type="text" class="form-control" name="telefone" />
                </div>
                <div class="form-group">
                    <label>E-mail:</label>
                    <input type="text" class="form-control" name="email" />
                </div>

                <div class="form-group">
                <input type="submit" class="form-control btn btn-primary" value="Cadastrar" />
                </div>
            </form>

            <table>
                <tr>
                    <th>
                        Contatos
                    </th>
                </tr>
                <?php 
                if(!empty($lista)):
                    foreach($lista as $contato): 
                ?>
                <tr>
                    <td><?= $contato['nome']; ?></td>
                    <td><?= $contato['telefone']; ?></td>
                    <td><?= $contato['email']; ?></td>
                </tr>
                <?php 
                    endforeach;
                else:
                    echo "<tr><td colspan='3'>Não existem contatos cadastradas</td></tr>";
                endif;
                ?>
            </table>
        </div>

    </div>  


    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>