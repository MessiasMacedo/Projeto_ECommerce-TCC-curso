<?php
session_start();
require_once __DIR__ . '../../app/repositores/Conecta.php'; // ajuste do caminho

// verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    die("Você precisa estar logado para comentar.");
}

$id_usuario = $_SESSION['usuario_id'];
$produto_id = $_POST['produto_id'];
$nota       = $_POST['nota'];
$comentario = $_POST['comentario'];

// inserir comentário
try {

    $sql = "INSERT INTO avaliacao (produto_id, nota, comentario, aprovado, id_usuario)
            VALUES (:produto_id, :nota, :comentario, 1, :id_usuario)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':produto_id', $produto_id, PDO::PARAM_INT);
    $stmt->bindParam(':nota', $nota, PDO::PARAM_INT);
    $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    $stmt->execute();

    // 🔥 🔥 VOLTA PARA O PRODUTO (agora funciona!)
    header("Location: /Projeto_ECommerce/web/views/Produto/produto.php?id=" . $produto_id);
    exit;

} catch (PDOException $e) {

    // se der erro, mostra a mensagem
    echo "Erro ao enviar comentário: " . $e->getMessage();
}
