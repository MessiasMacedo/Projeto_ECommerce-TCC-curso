<?php
session_start();
require_once __DIR__ . '../../app/repositores/Conecta.php';

// Verifica se o produto veio via GET
if (!isset($_GET['id'])) {
    die("Produto inválido!");
}

$produto_id = intval($_GET['id']);

// Se não existir um carrinho_id na sessão, cria um novo
if (!isset($_SESSION['carrinho_id'])) {
    // Cria carrinho na tabela carrinho
    $stmt = $pdo->prepare("INSERT INTO carrinho(cliente_id, criado_em) VALUES (?, NOW())");
    $stmt->execute([$_SESSION['usuario_id']]);
    $_SESSION['carrinho_id'] = $pdo->lastInsertId();
}

$carrinho_id = $_SESSION['carrinho_id'];

// Buscar preço do produto
$stmt = $pdo->prepare("SELECT preco FROM produto WHERE id = ?");
$stmt->execute([$produto_id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado!");
}

$preco = $produto['preco'];

// Verificar se o produto já está no carrinho
$stmt = $pdo->prepare("SELECT * FROM carrinhoitem WHERE carrinho_id = ? AND produto_id = ?");
$stmt->execute([$carrinho_id, $produto_id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if ($item) {
    // Atualiza quantidade +1
    $stmt = $pdo->prepare("
        UPDATE carrinhoitem 
        SET quantidade = quantidade + 1 
        WHERE carrinho_id = ? AND produto_id = ?
    ");
    $stmt->execute([$carrinho_id, $produto_id]);
} else {
    // Insere novo item
    $stmt = $pdo->prepare("INSERT INTO carrinhoitem (carrinho_id, produto_id, quantidade, preco_unitario)
                           VALUES (?, ?, 1, ?)");
    $stmt->execute([$carrinho_id, $produto_id, $preco]);
}

// Redireciona de volta para a página anterior
header("Location: ".$_SERVER['HTTP_REFERER']);
exit;
