<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

require 'config/db.php';

// Buscar tarefas pendentes
$stmtPendentes = $pdo->prepare("
    SELECT * FROM tasks 
    WHERE status = 'pendente' 
    ORDER BY data_criacao DESC
");
$stmtPendentes->execute();
$tarefasPendentes = $stmtPendentes->fetchAll(PDO::FETCH_ASSOC);

// Buscar tarefas concluídas
$stmtConcluidas = $pdo->prepare("
    SELECT * FROM tasks 
    WHERE status = 'concluida' 
    ORDER BY data_criacao DESC
");
$stmtConcluidas->execute();
$tarefasConcluidas = $stmtConcluidas->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>

    <!-- Bootstrap CSS (CDN) -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous"
    >

    <!-- Estilo customizado -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container d-flex justify-content-between">
            <span class="navbar-brand mb-0 h1">📋 Lista de Tarefas</span>

            <a href="logout.php" class="btn btn-outline-light btn-sm">
                Sair
            </a>
        </div>
    </nav>


   <div class="container">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📋 Minhas Tarefas</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovaTarefa">
            ➕ Nova Tarefa
        </button>
    </div>

    <div class="row">
        <!-- COLUNA PENDENTES -->
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-warning-subtle">
                    <strong>⏳ Tarefas Pendentes</strong>
                </div>
                <div class="card-body">

                    <?php if(count($tarefasPendentes) === 0): ?>
                        <p class="text-muted text-center mb-0">
                            Nenhuma tarefa pendente.
                        </p>
                    <?php else: ?>
                        <?php foreach($tarefasPendentes as $t): ?>
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div>
                                    <strong>
                                        <?= htmlspecialchars($t['titulo']) ?>
                                    </strong>
                                    <br>
                                    <small class="text-muted">
                                        <?= $t['data_criacao'] ?>
                                    </small>
                                </div>

                                <div class="text-end">
                                    <a href="concluir_tarefa.php?id=<?= $t['id'] ?>" 
                                       class="btn btn-sm btn-success mb-1">
                                       ✔ Concluir
                                    </a>

                                    <button 
                                        class="btn btn-sm btn-warning mb-1 btn-editar"
                                        data-id="<?= $t['id'] ?>"
                                        data-titulo="<?= htmlspecialchars($t['titulo'], ENT_QUOTES) ?>"
                                        data-descricao="<?= htmlspecialchars($t['descricao'] ?? '', ENT_QUOTES) ?>"
                                        data-status="<?= $t['status'] ?>"
                                    >
                                        ✏ Editar
                                    </button>

                                    <a href="excluir_tarefa.php?id=<?= $t['id'] ?>" 
                                       class="btn btn-sm btn-danger mb-1"
                                       onclick="return confirm('Tem certeza que deseja excluir?')">
                                       🗑 Excluir
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <!-- COLUNA CONCLUÍDAS -->
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success-subtle">
                    <strong>✅ Tarefas Concluídas</strong>
                </div>
                <div class="card-body">

                    <?php if(count($tarefasConcluidas) === 0): ?>
                        <p class="text-muted text-center mb-0">
                            Nenhuma tarefa concluída ainda.
                        </p>
                    <?php else: ?>
                        <?php foreach($tarefasConcluidas as $t): ?>
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div>
                                    <strong class="text-success text-decoration-line-through">
                                        <?= htmlspecialchars($t['titulo']) ?>
                                    </strong>
                                    <br>
                                    <small class="text-muted">
                                        <?= $t['data_criacao'] ?>
                                    </small>
                                </div>

                                <div class="text-end">
                                    <!-- Aqui não mostramos 'Concluir', só Editar/Excluir -->
                                    <button 
                                        class="btn btn-sm btn-warning mb-1 btn-editar"
                                        data-id="<?= $t['id'] ?>"
                                        data-titulo="<?= htmlspecialchars($t['titulo'], ENT_QUOTES) ?>"
                                        data-descricao="<?= htmlspecialchars($t['descricao'] ?? '', ENT_QUOTES) ?>"
                                        data-status="<?= $t['status'] ?>"
                                    >
                                        ✏ Editar
                                    </button>

                                    <a href="excluir_tarefa.php?id=<?= $t['id'] ?>" 
                                       class="btn btn-sm btn-danger mb-1"
                                       onclick="return confirm('Tem certeza que deseja excluir?')">
                                       🗑 Excluir
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>


</div>

    
     <!-- MODAL NOVA TAREFA -->
    <div class="modal fade" id="modalNovaTarefa" tabindex="-1">
        <div class="modal-dialog">
            <form action="salvar_tarefa.php" method="POST" class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">📝 Nova Tarefa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                <label class="form-label">Título:</label>
                <input type="text" name="titulo" class="form-control" required>
                </div>
                <div class="mb-3">
                <label class="form-label">Descrição (opcional):</label>
                <textarea name="descricao" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>

            </form>
        </div>
    </div>

    <!-- MODAL EDITAR TAREFA -->
    <div class="modal fade" id="modalEditarTarefa" tabindex="-1">
        <div class="modal-dialog">
            <form action="atualizar_tarefa.php" method="POST" class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">✏ Editar Tarefa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input type="hidden" name="id" id="edit-id">

                <div class="mb-3">
                <label class="form-label">Título:</label>
                <input type="text" name="titulo" id="edit-titulo" class="form-control" required>
                </div>

                <div class="mb-3">
                <label class="form-label">Descrição:</label>
                <textarea name="descricao" id="edit-descricao" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" id="edit-status" class="form-select">
                    <option value="pendente">Pendente</option>
                    <option value="concluida">Concluída</option>
                </select>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Salvar alterações</button>
            </div>

            </form>
        </div>
    </div>




    <!-- jQuery (CDN) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>

    <!-- Bootstrap JS (CDN) -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous">
    </script>

    <!-- JS customizado -->
    <script src="assets/js/app.js"></script>
</body>
</html>
