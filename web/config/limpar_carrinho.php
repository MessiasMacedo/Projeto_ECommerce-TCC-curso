<?php
session_start();
require_once __DIR__ . '../../app/repositores/Conecta.php';

// Se não houver carrinho, não há nada pra limpar
if (!isset($_SESSION['carrinho_id'])) {
    header("Location: /Projeto_ECommerce/web/views/Carrinho/carrinho.php");
    exit;
}

$carrinho_id = $_SESSION['carrinho_id'];

// Apaga TODOS os itens do carrinho
$stmt = $pdo->prepare("DELETE FROM carrinhoitem WHERE carrinho_id = ?");
$stmt->execute([$carrinho_id]);

// Opcional: remover o carrinho também da tabela carrinho
// (use apenas se quiser resetar totalmente)
$pdo->prepare("DELETE FROM carrinho WHERE id = ?")->execute([$carrinho_id]);

// Remove o carrinho_id da sessão
unset($_SESSION['carrinho_id']);

header("Location: /Projeto_ECommerce/web/views/Carrinho/carrinho.php");
exit;
