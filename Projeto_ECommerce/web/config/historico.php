<?php
// historico.php - Carrega dados do pedido e itens (corrigido)
try {
    require_once __DIR__ . '../../app/repositores/Conecta.php';// ajuste o caminho conforme sua estrutura
    // garante que $pdo existe
    if (!isset($pdo) || !$pdo) {
        throw new Exception("Conexão PDO não encontrada em conecta.php");
    }

    // pega id do pedido pela query string ?id=123
    $idPedido = isset($_GET['id']) && is_numeric($_GET['id']) ? (int) $_GET['id'] : null;

    if ($idPedido) {
        $stmt = $pdo->prepare("SELECT * FROM historico WHERE id = ?");
        $stmt->execute([$idPedido]);
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // sem id, pega o último registro como fallback
        $stmt = $pdo->query("SELECT * FROM historico ORDER BY id DESC LIMIT 1");
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);
        $idPedido = $pedido['id'] ?? null;
    }
    

    if (!$pedido) {
        die("Nenhum histórico encontrado!");
    }

    // tabela de fretes (se você já tem essa parte em outro arquivo, adapte)
    $fretes_estado = [
        "AC" => 39.90, "AL" => 34.90, "AP" => 42.90, "AM" => 49.90,
        "BA" => 29.90, "CE" => 27.90, "DF" => 19.90, "ES" => 24.90,
        "GO" => 22.90, "MA" => 31.90, "MT" => 32.90, "MS" => 33.90,
        "MG" => 21.90, "PA" => 44.90, "PB" => 26.90, "PR" => 18.90,
        "PE" => 25.90, "PI" => 30.90, "RJ" => 15.90, "RN" => 28.90,
        "RS" => 17.90, "RO" => 45.90, "RR" => 46.90, "SC" => 16.90,
        "SP" => 12.90, "SE" => 29.90, "TO" => 35.90
    ];
// exemplo: de onde vem a sigla do estado?
$estado = $pedido['estado'] ?? ($_POST['estado'] ?? null);

// normalizar (remove espaços e coloca em maiúsculas)
if ($estado) {
    $estado = strtoupper(trim($estado));
}

// forma segura de pegar o frete a partir do array
if ($estado && array_key_exists($estado, $fretes_estado)) {
    $frete = (float) $fretes_estado[$estado];
} else {
    // se $pedido já tiver um frete salvo (ex.: quando o pedido foi criado com frete definido)
    if (isset($pedido['frete']) && $pedido['frete'] !== '') {
        // tratar caso venha com vírgula: "12,90"
        $valor = str_replace(',', '.', $pedido['frete']);
        $frete = (float) $valor;
    } else {
        // valor padrão (zero ou outro)
        $frete = 0.0;
    }
}
    // preencher variáveis usadas no fim.php (adapte os nomes conforme o seu código)
    $nome        = $pedido['nome'] ?? '';
    $email       = $pedido['email'] ?? '';
    $cpf         = $pedido['cpf'] ?? '';
    $telefone    = $pedido['telefone'] ?? '';
    $destinatario = $nome;

    $cep         = $pedido['cep'] ?? '';
    $endereco    = ($pedido['endereco'] ?? '') . (isset($pedido['numero']) ? ", " . $pedido['numero'] : '');
    $bairro      = $pedido['bairro'] ?? '';
    $complemento = $pedido['complemento'] ?? '';
    $estado      = $pedido['estado'] ?? '';
    $cidade      = $pedido['cidade'] ?? '';

$subtotal = (float)($pedido['subtotal'] ?? 0);

$total    = $frete +(float)($pedido['total'] ?? 0); // AQUI ESTÁ O VALOR CERTO


    $tipo_pagamento = $pedido['tipo_pagamento'] ?? '';
    $metodo_pagamento = $tipo_pagamento;

    // ---- Agora BUSCAR OS ITENS na tabela pedidoitem ----
    // prepara corretamente a consulta antes de executar
    $stmtItens = $pdo->prepare("
        SELECT produto_id, nome_peoduto, preco_unitario AS preco, quantidade
        FROM pedidoitem
        WHERE pedido_id = ?
    ");
    $stmtItens->execute([$idPedido]);
    $itens = $stmtItens->fetchAll(PDO::FETCH_ASSOC);

    // garante que $itens existe (mesmo que seja array vazio)
    if (!is_array($itens)) {
        $itens = [];
    }

} catch (PDOException $e) {
    // para desenvolvimento, mostrar erro (em produção, logue e mostre mensagem genérica)
    die("Erro no banco de dados: " . $e->getMessage());
} catch (Exception $e) {
    die("Erro: " . $e->getMessage());
}
