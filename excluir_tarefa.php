<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

require 'config/db.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: index.php');
exit;
?>
