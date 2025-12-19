<?php
session_start();
require_once __DIR__ . '/../../app/repositores/Conecta.php';

/* ============================
   LER FILTROS DO FORMULÁRIO
============================ */

$selectedSubs = $_GET['sub'] ?? [];
if (!is_array($selectedSubs)) {
    $selectedSubs = [$selectedSubs];
}
$selectedSubs = array_map('intval', $selectedSubs);

// Preço máximo
$precoMax = isset($_GET['preco']) && $_GET['preco'] !== ''
            ? (int) $_GET['preco']
            : 5000;

/* ============================
   MONTAR QUERY DINÂMICA
============================ */

$where = ["categoria_id = 2"]; // << SOMENTE HARDWARE

$params = [];

// Filtro por subcategoria
if (!empty($selectedSubs)) {
    $placeholders = implode(',', array_fill(0, count($selectedSubs), '?'));
    $where[] = "id_subcategoria IN ($placeholders)";
    $params = array_merge($params, $selectedSubs);
}

// Filtro por preço
$where[] = "preco <= ?";
$params[] = $precoMax;

$sql = "SELECT * FROM produto WHERE " . implode(" AND ", $where) . " ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS da HOME -->
    <link rel="stylesheet" href="../../public/css/home.css">

    <style>
        /* Ajustes específicos do Hardware */
  .filter-box {
            background: #2f2f2f;
            border-radius: 10px;
            padding: 15px;
            color: white;
            box-shadow: 0px 4px 14px rgba(0, 0, 0, .4);
        }
/* ===== CHECKBOX ESTILIZADO ===== */
.filtro-item {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 6px 0;
    cursor: pointer;
    user-select: none;
}

.check {
    appearance: none;
    width: 18px;
    height: 18px;
    border: 2px solid #777;
    border-radius: 4px;
    background: #1c1c1c;
    cursor: pointer;
    transition: .2s ease-in-out;
    position: relative;
}

/* Hover */
.filtro-item:hover .check {
    border-color: #aaa;
}

/* Marcado */
.check:checked {
    background: #007bff;
    border-color: #007bff;
}

    </style>

    <title>Hardware</title>
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

<!-- CONTEÚDO -->
<div class="container py-4">

    <div class="row">

        <!-- ================== FILTROS (MESMOS DA VERSÃO ANTIGA) ================== -->
     <aside class="col-md-3">
            <div class="filter-box">
                <form method="GET" id="formFiltros">

                    <h5>Filtros</h5>

                    <label><input  type="checkbox" class="check" name="sub[]" value="1" <?= in_array(1, $selectedSubs) ? 'checked' : '' ?>> Placa-mãe</label><br>
                    <label><input  type="checkbox" class="check" name="sub[]" value="2" <?= in_array(2, $selectedSubs) ? 'checked' : '' ?>> Processador</label><br>
                    <label><input type="checkbox" class="check"name="sub[]" value="3" <?= in_array(3, $selectedSubs) ? 'checked' : '' ?>> Memória RAM</label><br>
                    <label><input  type="checkbox" class="check" name="sub[]" value="4" <?= in_array(4, $selectedSubs) ? 'checked' : '' ?>> SSD</label><br>
                    <label><input  type="checkbox" class="check" name="sub[]" value="5" <?= in_array(5, $selectedSubs) ? 'checked' : '' ?>> HD</label><br>
                    <label><input  type="checkbox"  class="check" name="sub[]" value="6" <?= in_array(6, $selectedSubs) ? 'checked' : '' ?>> Placa de Vídeo</label><br>
                     <label><input  type="checkbox"  class="check" name="sub[]" value="7" <?= in_array(7, $selectedSubs) ? 'checked' : '' ?>> Fonte</label><br>
                    <hr>

                    <label class="mt-3 fw-bold">Preço máximo:</label>
                    <input type="range"
                           class="form-range"
                           min="100" max="5000"
                           id="rangePreco"
                           name="preco"
                           value="<?= $precoMax ?>">

                    <span id="priceValue" class="text-light">
                        R$ <?= $precoMax ?>
                    </span>

                </form>
            </div>
        </aside>

        <!-- ================== LISTA DE PRODUTOS ================== -->
       <main class="col-md-9">

            <h1 class="mb-4">Hardware</h1>

            <div class="row g-4">

                <?php if (empty($produtos)): ?>
                    <p class="text-light">Nenhum produto encontrado com esses filtros.</p>
                <?php endif; ?>

                <?php foreach ($produtos as $p): ?>
                    <div class="col-6 col-sm-4 col-md-4">
                        <div class="product-card">
                            <div class="product-img">
                                <img src="<?= htmlspecialchars($p['img']) ?>" alt="">
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

            </div>

        </main>
    </div>
</div>

<!-- FOOTER IGUAL HOME -->
<footer class="footer-custom">
    <div class="footer-line"></div>

    <div class="footer-content">
        <div class="footer-icons">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter-x"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-whatsapp"></i></a>
        </div>

        <a href="#" class="footer-text">E-mail: exemplo@gmail.com</a>
        <a href="#" class="footer-text">Telefone: (11) 0000-0000</a>
        <a href="#" class="footer-text">Atendimento ao Cliente</a>
        <div> <span class="footer-text">&copy; Copyright 2025 - Direitos Reservados</span></div>
    </div>
    
</footer>
<script>  // Atualiza texto do slider
    const slider = document.getElementById("rangePreco");
    const priceText = document.getElementById("priceValue");

    slider.addEventListener("input", function() {
        priceText.textContent = "R$ " + this.value;
    });

    // Atualiza a página ao mudar qualquer filtro
    document.querySelectorAll("#formFiltros input").forEach(input => {
        input.addEventListener("change", () => {
            document.getElementById("formFiltros").submit();
        });
    });
</script>
<script>
    // Atualiza o valor do range
    const range = document.getElementById("rangePreco");
    const value = document.getElementById("priceValue");

    range.oninput = () => {
        value.textContent = "R$ " + range.value;
    };</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
