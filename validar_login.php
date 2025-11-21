<?php
session_start();

// Usuário fixo para teste
$usuario_correto = 'admin';
$senha_correta = '123';

if($_POST['usuario'] === $usuario_correto && $_POST['senha'] === $senha_correta) {
    $_SESSION['usuario'] = $usuario_correto;
    header('Location: index.php');
} else {
    header('Location: login.php?erro=1');
}
exit;
?>
