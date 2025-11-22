<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

require 'config/db.php';



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

        <!-- LISTA DE TAREFAS -->
        <div class="card shadow-sm">
            <div class="card-body">

                <?php
                $stmt = $pdo->query("SELECT * FROM tasks ORDER BY status, data_criacao DESC");
                $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if(count($tarefas) == 0):
                ?>
                    <p class="text-center text-muted">Nenhuma tarefa cadastrada ainda.</p>
                <?php
                else:
                    foreach($tarefas as $t):
                ?>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <strong class="<?= $t['status'] === 'concluida' ? 'text-success text-decoration-line-through' : '' ?>">
                                    <?= htmlspecialchars($t['titulo']) ?>
                                </strong>
                                <br>
                                <small class="text-muted"><?= $t['data_criacao'] ?></small>
                            </div>

                            <div>
                                <?php if($t['status'] === 'pendente'): ?>
                                    <a href="concluir_tarefa.php?id=<?= $t['id'] ?>" 
                                    class="btn btn-sm btn-success">
                                    ✔ Concluir
                                    </a>
                                <?php endif; ?>

                                <button 
                                    class="btn btn-sm btn-warning btn-editar"
                                    data-id="<?= $t['id'] ?>"
                                    data-titulo="<?= htmlspecialchars($t['titulo'], ENT_QUOTES) ?>"
                                    data-descricao="<?= htmlspecialchars($t['descricao'] ?? '', ENT_QUOTES) ?>"
                                    data-status="<?= $t['status'] ?>"
                                >
                                    ✏ Editar
                                </button>

                                <a href="excluir_tarefa.php?id=<?= $t['id'] ?>" 
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Tem certeza que deseja excluir?')">
                                🗑 Excluir
                                </a>
                            </div>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>

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
