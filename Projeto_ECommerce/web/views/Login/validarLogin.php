<?php
session_start();
require_once __DIR__ . "/../../app/repositores/Conecta.php";

// Garante que o PDO existe
if (!isset($pdo)) {
    die("ERRO: conexão não carregada.");
}

$email = $_POST['email'] ?? '';

$senha = $_POST['senha'] ?? '';

// Busca usuário por email
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Se encontrou o usuário
if ($usuario && password_verify($senha, $usuario['senha'])) {

    // Cria sessão
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    $_SESSION['usuario_email'] = $usuario['email'];
    $_SESSION['usuario_tipo'] = $usuario['tipo'];

    // Redireciona
    if (isset($_SESSION['redirect_after_login'])) {
        $url = $_SESSION['redirect_after_login'];
        unset($_SESSION['redirect_after_login']);
        header("Location: $url");
        exit;
    }
    
    header("Location: /Projeto_ECommerce/web/views/Home/home.php");
    exit;
}

// Se chegou aqui = erro
header("Location: /Projeto_ECommerce/web/views/Login/AcessarConta.php?erro=1");
exit;
