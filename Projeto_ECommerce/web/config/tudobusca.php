<?php

require_once __DIR__ . '../../app/repositores/Conecta.php';
// ===============================
// 1. CAPTURA PARÂMETROS DO GET
// ===============================
$termoBusca = $_GET['q']         ?? '';
$categoria  = $_GET['categoria'] ?? [];
$precoMin   = isset($_GET['preco_min']) ? (float)$_GET['preco_min'] : 0;
$precoMax   = isset($_GET['preco_max']) ? (float)$_GET['preco_max'] : 5000;
$ordem      = $_GET['ordem']     ?? '';
$paginaAtual = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$porPagina   = 12;

// Garante que categoria seja sempre array
if (!is_array($categoria)) {
    $categoria = [$categoria];
}

// ===============================
// 2. BUSCA LISTA DE CATEGORIAS
//    PARA EXIBIR NO FILTRO
// ===============================
if (trim($termoBusca) !== '') {
    $sqlCat = "
        SELECT DISTINCT c.id, c.nome, COUNT(p.id) AS total
        FROM produto p
        INNER JOIN categoria c ON p.categoria_id = c.id
        WHERE p.nome LIKE :termo OR p.descricao LIKE :termo
        GROUP BY c.id
        ORDER BY c.nome ASC
    ";
    $stmtCat = $pdo->prepare($sqlCat);
    $stmtCat->bindValue(':termo', "%{$termoBusca}%");
    $stmtCat->execute();
    $categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sqlCat = "
        SELECT c.id, c.nome, COUNT(p.id) AS total
        FROM categoria c
        LEFT JOIN produto p ON p.categoria_id = c.id
        GROUP BY c.id
        ORDER BY c.nome ASC
    ";
    $categorias = $pdo->query($sqlCat)->fetchAll(PDO::FETCH_ASSOC);
}

// ===============================
// 3. MONTA QUERY BASE (COM FILTROS)
// ===============================
$where = "WHERE (p.nome LIKE :busca OR p.descricao LIKE :busca)
          AND p.preco BETWEEN :precoMin AND :precoMax";

$params = [
    ':busca'    => "%{$termoBusca}%",
    ':precoMin' => $precoMin,
    ':precoMax' => $precoMax,
];

// Filtro por categoria (checkbox)
$placeholdersCat = [];
if (!empty($categoria)) {
    $categoria = array_filter($categoria, 'strlen'); // remove vazios
    if (!empty($categoria)) {
        foreach ($categoria as $idx => $catId) {
            $ph = ":cat{$idx}";
            $placeholdersCat[] = $ph;
            $params[$ph] = (int)$catId;
        }
        if (!empty($placeholdersCat)) {
            $where .= " AND p.categoria_id IN (" . implode(',', $placeholdersCat) . ")";
        }
    }
}

// ===============================
// 4. QUERY PARA CONTAR TOTAL
// ===============================
$sqlCount = "SELECT COUNT(*) AS total
             FROM produto p
             LEFT JOIN categoria c ON c.id = p.categoria_id
             {$where}";

$stmtCount = $pdo->prepare($sqlCount);

// Bind dos parâmetros no COUNT
foreach ($params as $chave => $valor) {
    $stmtCount->bindValue($chave, $valor, is_int($valor) || is_float($valor) ? PDO::PARAM_STR : PDO::PARAM_STR);
}

$stmtCount->execute();
$totalRegistros = (int)$stmtCount->fetchColumn();

// Cálculo de paginação
$totalPaginas = max(1, ceil($totalRegistros / $porPagina));
if ($paginaAtual > $totalPaginas) {
    $paginaAtual = $totalPaginas;
}
$offset = ($paginaAtual - 1) * $porPagina;

// ===============================
// 5. QUERY PRINCIPAL DE PRODUTOS
// ===============================
$sql = "SELECT p.*, c.nome AS categoria_nome
        FROM produto p
        LEFT JOIN categoria c ON c.id = p.categoria_id
        {$where}";

// Ordenação
switch ($ordem) {
    case 'preco_asc':
        $sql .= " ORDER BY p.preco ASC";
        break;
    case 'preco_desc':
        $sql .= " ORDER BY p.preco DESC";
        break;
    default:
        $sql .= " ORDER BY p.id DESC";
}

// LIMIT e OFFSET
$sql .= " LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($sql);

// Bind dos parâmetros da busca
foreach ($params as $chave => $valor) {
    // Todos como string funciona bem; se quiser, pode diferenciar
    $stmt->bindValue($chave, $valor);
}

// Bind do limit/offset (inteiros)
$stmt->bindValue(':limit',  $porPagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset,    PDO::PARAM_INT);

$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);