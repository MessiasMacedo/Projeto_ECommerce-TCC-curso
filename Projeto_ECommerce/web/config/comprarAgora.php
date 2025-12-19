<?php
session_start();
require_once __DIR__ . '../../app/repositores/Conecta.php';

$id = $_GET['id'] ?? '';

if ($id == '' || !is_numeric($id)) {
    die("Produto inválido.");
}

$sql = $pdo->prepare("SELECT * FROM produto WHERE id = ?");
$sql->execute([$id]);
$produto = $sql->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado!");
}

// Criar sessão de compra direta
$_SESSION['compra_direta'] = [
    'id' => $produto['id'],
    'nome' => $produto['nome'],
    'preco' => $produto['preco'],
    'img' => $produto['img'],
    'quantidade' => 1,
    'subtotal' => $produto['preco'],
    'total' => $produto['preco']
];

// Redireciona para a página de finalizar
header("Location: /Projeto_ECommerce/web/views/Finalizar/finalizar.php?compra=agora");
exit;
?>
