<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

require 'config/db.php';

if($_POST['titulo']) {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'] ?? '';

    $stmt = $pdo->prepare("INSERT INTO tasks (titulo, descricao) VALUES (:t, :d)");
    $stmt->execute([
        ':t' => $titulo,
        ':d' => $descricao
    ]);

    header('Location: index.php?ok=1');
    exit;
} else {
    header('Location: index.php?erro=1');
    exit;
}
?>
