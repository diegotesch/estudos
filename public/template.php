
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
            <h1>Gerenciador de Tarefas</h1>

            <?php
                // var_dump($validate);
                if(isset($validate['errors'])):
                    echo "<div class='alert alert-danger'>";
                    echo "<p>Os seguintes campos apresentam erros:</p>";
                    foreach($validate['erros_validacao'] as $chave => $valor):
                        echo "<p><b>$chave</b> - $valor</p>";
                    endforeach;
                    echo "</div>";
                endif;  
            ?>

            <?php include_once 'formulario.php' ?>
            

            <?php 
            if($exibir_tabela):
                include_once 'tabela.php'; 
            endif;
            ?>

        </div>
    </div>


    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>