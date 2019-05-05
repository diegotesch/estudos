<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerenciador de Tarefas</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
</head>
<body>
    <div class="main">
        <div class="container">
            <h1>Tarefa: <?= $tarefa['nome']; ?> </h1>
            <p>
                <a href="index.php" class="btn btn-primary">Voltar para a lista de tarefas</a>
            </p>

            <p>
                <strong>Concluída:</strong>
                <?= $tarefa['concluida'] == 1 ? 'Concluída' : 'Em andamento' ?>
            </p>
            <p>
                <strong>Descrição:</strong>
                <?= nl2br($tarefa['descricao']) ?>
            </p>
            <p>
                <strong>Prazo:</strong>
                <?= data_translate($tarefa['prazo']) ?>
            </p>
            <p>
                <strong>Prioridade:</strong>
                <?= prioridade_translate($tarefa['prioridade']) ?>
            </p>

            <h2>Anexos</h2>

            <!--lista de anexos-->
            <?php if(isset($anexos) && count($anexos) > 0): ?>
                <table>
                    <tr>
                        <th>Arquivo</th>
                        <th>Opções</th>
                    </tr>

                    <?php foreach($anexos as $anexo): ?>
                        <tr>
                            <td><?= $anexo['nome'] ?></td>
                            <td><a href="anexos/<?= $anexo['arquivo'] ?>">Download</a></td>
                            <td><a href="remover_anexo.php?id=<?= $anexo['id']; ?>">Remover</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>Não há anexos para esta tarefa</p>
    	    <?php endif; ?>
            <!-- formulario para um novo anexo-->
            <?php
                if((isset($tem_erros) && $tem_erros == true) && array_key_exists('anexo', $erros_validacao)):
            ?>
                <div class="alert alert-danger">
                    <?= $erros_validacao['anexo'] ?>
                </div>
            <?php
                endif;
            ?>
            
            <div class="form">
                <form action="" method="post" enctype="multipart/form-data">
                    <fieldset class="form-group">
                        <legend>Novo anexo</legend>
                    </fieldset>

                    <input type="hidden" name="tarefa_id" value="<?= $tarefa['id'] ?>" />

                    <div class="form-group">
                        <input type="file" class="form-control" name="anexo" />
                    </div>

                    <input type="submit" class="form-control btn btn-primary" value="anexar" />
                </form>
            </div>
        </div>
    </div>



    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>