<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

require 'config/db.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("UPDATE tasks SET status = 'concluida' WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: index.php');
exit;
?>
