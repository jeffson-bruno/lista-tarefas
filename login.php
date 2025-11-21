<?php
session_start();

// Se já estiver logado, redireciona para index
if(isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Lista de Tarefas</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-center mb-3">🔐 Login</h4>

                    <?php if(isset($_GET['erro'])): ?>
                        <div class="alert alert-danger py-1">
                            Usuário ou senha incorretos.
                        </div>
                    <?php endif; ?>

                    <form action="validar_login.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Usuário:</label>
                            <input type="text" name="usuario" class="form-control" placeholder="Digite admin" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Senha:</label>
                            <input type="password" name="senha" class="form-control" placeholder="Digite 123" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Entrar</button>
                    </form>
                </div>
            </div>

            <p class="text-center mt-3 text-muted">Usuário: admin | Senha: 123</p>

        </div>
    </div>
</div>

</body>
</html>
