<?php
// futuramente aqui vamos verificar se o usuário está logado
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
        <div class="container">
            <span class="navbar-brand mb-0 h1">📋 Lista de Tarefas</span>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Bem-vindo!</h5>
                        <p class="card-text">
                            Este será o painel da sua <strong>Lista de Tarefas</strong>. <br>
                            Nos próximos passos vamos:
                        </p>
                        <ul>
                            <li>Criar a tela de login</li>
                            <li>Criar o CRUD de tarefas</li>
                            <li>Usar jQuery + AJAX pra deixar tudo dinâmico</li>
                        </ul>
                        <p class="text-muted mb-0">
                            Por enquanto, isso é só o esqueleto inicial do projeto.
                        </p>
                    </div>
                </div>

            </div>
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
