<?php
session_start();
require_once __DIR__ . '../../app/repositores/Conecta.php';

// Receber dados
$nome       = $_POST['nome'] ?? '';
$cpf        = $_POST['cpf'] ?? '';
$email      = $_POST['email'] ?? '';
$telefone   = $_POST['telefone'] ?? '';

$cep        = $_POST['cep'] ?? '';
$endereco   = $_POST['endereco'] ?? '';
$numero     = $_POST['numero'] ?? '';
$bairro     = $_POST['bairro'] ?? '';
$complemento= $_POST['complemento'] ?? '';
$estado     = $_POST['estado'] ?? '';
$cidade     = $_POST['cidade'] ?? '';


$subtotal   = $_SESSION['subtotal'] ?? 0;
$frete      = $_SESSION['frete'] ?? 0;
$total = $_POST['total'] ?? $_SESSION['total'] ?? 0;
$descontos  = $_SESSION['descontos'] ?? 0;

$tipo_pagamento = $_POST['tipo_pagamento'] ?? '';

$_SESSION['total'] = $total;
$_SESSION['subtotal'] = $subtotal;
$_SESSION['frete'] = $frete;
$_SESSION['descontos'] = ($_SESSION['subtotal'] + $_SESSION['frete']) - $total;


$sql = "INSERT INTO historico 
(nome, cpf, email, telefone, cep, endereco, numero, bairro, complemento, estado, cidade, subtotal, frete, total, tipo_pagamento)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $pdo->prepare($sql);

// Executa apenas UMA VEZ
if ($stmt->execute([
    $nome, $cpf, $email, $telefone,
    $cep, $endereco, $numero, $bairro, $complemento, $estado, $cidade,
    $subtotal, $frete, $total, $tipo_pagamento
])) {

    // pegar o último ID gerado
    $ultimo_id = $pdo->lastInsertId();
    $idPedido = $pdo->lastInsertId();

foreach ($_SESSION['carrinho'] as $item) {
    $sqlItem = $pdo->prepare("
        INSERT INTO pedidoitem
        (pedido_id, produto_id, nome_produto, preco_unitario, quantidade)
        VALUES (?, ?, ?, ?, ?)
    ");
    
    $sqlItem->execute([
        $idPedido,
        $item['id'],
        $item['nome'],
        $item['preco'],
        $item['quantidade']
    ]);
}
    // redirecionar
    header("Location: /Projeto_ECommerce/web/views/Fim/fim.php?id=$ultimo_id");
    exit();
} else {
    echo "Erro ao salvar pedido!";
}
