<?php
session_start();
require_once __DIR__ . '../../app/repositores/Conecta.php';

if (!isset($_GET['id']) || !isset($_GET['acao'])) die("Requisição inválida");

$carrinho_id = $_SESSION['carrinho_id'];
$produto_id  = intval($_GET['id']);
$acao        = $_GET['acao'];

if ($acao === "mais") {
    $pdo->prepare("
        UPDATE carrinhoitem 
        SET quantidade = quantidade + 1 
        WHERE carrinho_id = ? AND produto_id = ?
    ")->execute([$carrinho_id, $produto_id]);
}

if ($acao === "menos") {
    $pdo->prepare("
        UPDATE carrinhoitem 
        SET quantidade = GREATEST(quantidade - 1, 1)
        WHERE carrinho_id = ? AND produto_id = ?
    ")->execute([$carrinho_id, $produto_id]);
}

header("Location: /Projeto_ECommerce/web/views/Carrinho/carrinho.php");
exit;
