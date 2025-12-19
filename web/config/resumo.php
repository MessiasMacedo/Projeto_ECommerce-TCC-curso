<?php
require_once __DIR__ . '../../app/repositores/Conecta.php';

// Verifica se existe ?id= na URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("Produto inválido.");
}
    

// Buscar produto
$sql = "SELECT * FROM produto WHERE id = :id LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");
}

$subtotal = $produto["preco"];
$descontos = 0;
$total_final = $subtotal;
$avista = $total_final; 
$parcelas = $total_final/12;

// Variável usada pelo HTML
$mensagem = "";
