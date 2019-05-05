<form class="form" action="" method="post">
    <fieldset class="form-group">
        <legend>Nova Tarefa</legend>
    </fieldset>

    <div class="form-group">
        <label>Tarefa:</label>
        <input type="text" class="form-control" name="nome" value="<?= $tarefa['nome'] ?>" />
    </div>

    <input type="hidden" name="id" value="<?= $tarefa['id'] ?? ''; ?>" />

    <div class="form-group">
        <label>Descrição (opcional):</label>
        <textarea class="form-control" name="descricao"><?= $tarefa['descricao'] ?></textarea>
    </div>
    <div class="form-group">
        <label>Prazo (opcional):</label>
        <input type="date" class="form-control" name="prazo" value="<?= data_translate($tarefa['prazo']); ?>" />
    </div>
    <div class="form-group">
        <label for="">Prioriodade:</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="prioridade" value="1" <?= $tarefa['prioridade'] == 1 ? 'checked' : '' ?> >
            <label class="form-check-label">Baixa</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="prioridade" value="2" <?= $tarefa['prioridade'] == 2 ? 'checked' : '' ?> >
            <label class="form-check-label">Média</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="prioridade" value="3" <?= $tarefa['prioridade'] == 3 ? 'checked' : '' ?> >
            <label class="form-check-label">Alta</label>
        </div>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name='concluida' value="1" <?= $tarefa['concluida'] == 1 ? 'checked' : '' ?> />
            <label class="form-check-label">Tarefa concluída</label>
        </div>


    </div>

    <div class="form-group">
        <input type="submit" class="form-control btn btn-primary" value="<?= $tarefa['id'] ? 'Atualizar' : 'Cadastrar' ?> " />
        <?php if(isset($_GET['id'])): ?>
            <a href="index.php" class="form-control btn btn-warning">Cancelar</a>
        <?php endif; ?>
        </div>
</form>