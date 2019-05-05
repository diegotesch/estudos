<table class="table table-striped table-hover table-bordered">
    <tr>
        <th>ID</th>
        <th>Tarefas</th>
        <th>Descrição</th>
        <th>Prazo</th>
        <th>Prioridade</th>
        <th>Concluída</th>
        <th colspan='99'>Opções</th>
    </tr>
    <?php
    if (!empty($lista)) :
        foreach ($lista as $tarefa) :
            ?>
            <tr>
                <td><?= ucfirst($tarefa['id']); ?></td>
                <td><?= ucfirst($tarefa['nome']); ?></td>
                <td><?= ucfirst($tarefa['descricao']); ?></td>
                <td><?= (!empty($tarefa['prazo']) ? data_translate($tarefa['prazo']) : 'Indefinido'); ?></td>
                <td><?= prioridade_translate($tarefa['prioridade']) ?></td>
                <td><?= ($tarefa['concluida'] == 1 ? 'Concluida' : 'Em andamento'); ?></td>
                <td><a href="editar.php?id=<?= $tarefa['id']; ?>">Editar</a></td>
                <td><a href="excluir.php?id=<?= $tarefa['id']; ?>">Remover</a></td>
                <td><a href="duplicar.php?id=<?= $tarefa['id']; ?>">Duplicar</a></td>
            </tr>
        <?php
    endforeach;
    ?>
    <tr><td colspan="99"><a href="delete_all.php" class="btn btn-danger">Apagar Concluídas</a></td></tr>
<?php
else :
    echo "<tr><td>Não existem tarefas cadastradas</td></tr>";
endif;
?>
</table>