<?php
session_start();
require_once __DIR__ . '/../../app/repositores/Conecta.php';

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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Resultados da Busca</title>

    <!-- Bootstrap e ícones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Mesmo CSS do home -->
    <link rel="stylesheet" href="/Projeto_ECommerce/web/public/css/home2.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container-fluid">

        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="/Projeto_ECommerce/web/views/Home/home.php">
            Bit<span id="up">UP</span>
        </a>

        <!-- Botão mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Conteúdo -->
        <div class="collapse navbar-collapse " id="navbarContent">

            <!-- Barra de busca alinhada ao centro -->
            <div class="navbar-center flex-grow-1 d-flex justify-content-center">
    <form class="search-wrapper w-100 d-flex justify-content-center"
        action="/Projeto_ECommerce/web/views/Home/busca.php" method="GET">
        <input id="searchInput" name="q" class="form-control search-input"
            type="search" placeholder="O que você está procurando?" autocomplete="off">
    </form>
</div>

            <!-- Ícones à direita -->
            <div class="d-flex align-items-center">

                <a href="/Projeto_ECommerce/web/views/Carrinho/carrinho.php" class="me-3">
                    <i class="bi bi-cart3 fs-4 text-white"></i>
                </a>

                <?php if (isset($_SESSION['usuario_id'])): ?>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/Projeto_ECommerce/web/views/Login/logout.php">Sair</a></li>
                    </ul>
                </div>

                <?php else: ?>
                <a href="/Projeto_ECommerce/web/views/Login/Login.php" class="btn btn-outline-light btn-sm fw-semibold">
                    Iniciar Sessão
                </a>
                <?php endif; ?>

            </div>

        </div>
    </div>
</nav>

  <!-- BARRA SUPERIOR -->
  <div class="topbar">
    <div class="topbar-container">
        <a href="/Projeto_ECommerce/web/views/Home/home.php">Início</a>
        <a href="/Projeto_ECommerce/web/views/Hardware/hardware.php">Hardware</a>
        <a href="/Projeto_ECommerce/web/views/Perifericos/Perifericos.php">Periférico</a>
    </div>
</div>

    <!-- 🔹 CONTEÚDO PRINCIPAL -->
    <div class="container-fluid py-4">
        <div class="row">

            <!-- FILTRO LATERAL (ESQUERDO) -->
            <div class="col-md-3 mb-3">
                <div class="sidebar-fixed">
                    <?php
                    // Aqui o filtro.php usa:
                    // $termoBusca, $precoMin, $precoMax, $categorias, $categoria, $ordem
                    include __DIR__ . '/filtro.php';
                    ?>
                </div>
            </div>

            <!-- RESULTADOS (DIREITA) -->
            <div class="col-md-9">
                <h2 class="section-title">Resultados da busca</h2>

                <?php if (strlen(trim($termoBusca)) > 0): ?>
                    <p>
                        🔎 Você buscou por
                        "<strong><?= htmlspecialchars($termoBusca) ?></strong>" —
                        <?= $totalRegistros ?> resultado(s) encontrados
                    </p>
                <?php else: ?>
                    <p><?= $totalRegistros ?> produto(s) encontrado(s).</p>
                <?php endif; ?>

                <!-- GRID DE PRODUTOS -->
                <div class="row g-4">
                    <?php if (!empty($resultados)): ?>
                        <?php foreach ($resultados as $p): ?>
                            <div class="col-6 col-sm-4 col-md-3">
                                <div class="product-card">
                                    <div class="product-img">
                                        <img src="<?= htmlspecialchars($p['img'] ?? 'default.png') ?>" alt="">
                                    </div>
                                    <h5 class="product-title"><?= htmlspecialchars($p['nome']) ?></h5>
                                    <p class="product-desc"><?= htmlspecialchars($p['descricao']) ?></p>
                                    <div class="product-price">
                                        R$ <?= number_format($p['preco'], 2, ',', '.') ?>
                                    </div>
                                    <a href="/Projeto_ECommerce/web/views/Produto/produto.php?id=<?= $p['id'] ?>">
                                        <button class="btn-buy">Ver Produto</button>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Nenhum produto encontrado com os filtros selecionados.</p>
                    <?php endif; ?>
                </div>

                <!-- PAGINAÇÃO -->
                <?php if ($totalPaginas > 1): ?>
                    <?php
                    // Preserva os filtros na paginação
                    $queryBase = $_GET;
                    ?>
                    <nav aria-label="Navegação de página">
                        <ul class="pagination justify-content-center mt-4">
                            <?php for ($pag = 1; $pag <= $totalPaginas; $pag++): ?>
                                <?php
                                $queryBase['page'] = $pag;
                                $link = 'busca.php?' . http_build_query($queryBase);
                                ?>
                                <li class="page-item <?= ($pag == $paginaAtual) ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= htmlspecialchars($link) ?>">
                                        <?= $pag ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <!-- 🔹 FOOTER IGUAL AO HOME -->
    <footer class="text-white mt-5">
        <div class="container py-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <a href="#" class="text-white me-3 fs-4"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3 fs-4"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-white me-3 fs-4"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white fs-4"><i class="bi bi-whatsapp"></i></a>
                </div>
                <div class="text-white d-flex flex-wrap gap-5">
                    <span>E-mail: exemplo@gmail.com</span>
                    <span>Telefone: (11) 0000-0000</span>
                    <span>Atendimento ao Cliente</span>
                     <div> <span class="footer-text">&copy; Copyright 2025 - Direitos Reservados</span></div>
                </div>
            </div>
        </div>
       
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
