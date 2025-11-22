<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

require 'config/db.php';

if(isset($_POST['id'], $_POST['titulo'], $_POST['status'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'] ?? '';
    $status = $_POST['status'] === 'concluida' ? 'concluida' : 'pendente';

    $stmt = $pdo->prepare("
        UPDATE tasks 
        SET titulo = :t, descricao = :d, status = :s
        WHERE id = :id
    ");

    $stmt->execute([
        ':t' => $titulo,
        ':d' => $descricao,
        ':s' => $status,
        ':id' => $id
    ]);
}

header('Location: index.php');
exit;
?>
