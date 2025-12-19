<?php


require_once __DIR__ . '../../app/repositores/Conecta.php';

$mensagem = "";
$descontos = 0;

// Só executa se clicou em "APLICAR"
if (isset($_POST['aplicar'])) {

    $codigo_digitado = strtoupper(trim($_POST['cupom']));

    $sql = "SELECT * FROM cupom
            WHERE codigo = :codigo
            AND ativo = 1
            AND CURDATE() BETWEEN valido_de AND valido_ate
            LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":codigo", $codigo_digitado);
    $stmt->execute();

    $cupom = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cupom) {

        $subtotal = $_SESSION['subtotal'] ?? ($_SESSION['compra_direta']['subtotal'] ?? 0);


        if ($cupom['tipo'] === "percentual") {
            $descontos = $subtotal * ($cupom['valor'] / 100);
        } else {
            $descontos = $cupom['valor'];
        }

        $total_final = $subtotal - $descontos;
        if ($total_final < 0) $total_final = 0;


        // 🔥 SALVA NA SESSÃO
        $_SESSION['descontos'] = $descontos;
        $_SESSION['total'] = $total_final;

        $mensagem = "<p style='color: #4CAF50;'>Cupom <strong>$codigo_digitado</strong> aplicado!</p>";

    } else {
        $mensagem = "<p style='color: red;'>Cupom inválido ou inativo.</p>";
    }
}
