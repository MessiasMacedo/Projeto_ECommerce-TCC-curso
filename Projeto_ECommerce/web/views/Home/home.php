<?php
session_start();
require_once __DIR__ . '/../../app/repositores/Conecta.php';



$usuario_logado = isset($_SESSION['usuario_id']);

// Função para buscar produtos por categoria
function buscarProdutos($pdo, $categoriaID) {
    try {
        $sql = "SELECT * FROM produto WHERE categoria_id = :cat ORDER BY id DESC LIMIT 4";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['cat' => $categoriaID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return []; // evita warnings
    }
}

// Garantindo que NUNCA fiquem nulas
$produtos    = buscarProdutos($pdo, 1,2) ?? [];
$perifericos = buscarProdutos($pdo, 1) ?? [];
$pecas       = buscarProdutos($pdo, 2) ?? [];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
 
    <link rel="stylesheet" href="../../public/css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <title>Home</title>
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

    <!-- CARROSSEL -->
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../../public/img/a.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../../public/img/b.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- LISTA DE PRODUTOS -->
    <div class="container py-4">

    <!-- ==================== PRODUTOS ==================== -->
    <h1 class="section-title">Produtos</h1>
    <div class="row g-4">

        <?php foreach ($produtos as $p): ?>
        <div class="col-6 col-sm-4 col-md-3">
            <div class="product-card">
                <div class="product-img">
                    <img src="<?= htmlspecialchars($p['img']) ?>" alt="">
                </div>
                <h5 class="product-title"><?= htmlspecialchars($p['nome']) ?></h5>
                <p class="product-desc"><?= htmlspecialchars($p['descricao']) ?></p>
                <div class="product-price">R$ <?= number_format($p['preco'], 2, ',', '.') ?></div>
                <a href="/Projeto_ECommerce/web/views/Produto/produto.php?id=<?= $p['id'] ?>">
    <button class="btn-buy">Ver Produto</button>
</a>
            </div>
        </div>
        <?php endforeach; ?>

    </div>

    <!-- ==================== PERIFÉRICOS ==================== -->
    <h1 class="section-title mt-5">Periféricos</h1>
    <div class="row g-4">

        <?php foreach ($perifericos as $p): ?>
        <div class="col-6 col-sm-4 col-md-3">
            <div class="product-card">
                <div class="product-img">
                    <img src="<?= htmlspecialchars($p['img']) ?>" alt="">
                </div>
                <h5 class="product-title"><?= htmlspecialchars($p['nome']) ?></h5>
                <p class="product-desc"><?= htmlspecialchars($p['descricao']) ?></p>
                <div class="product-price preco-produto">R$ <?= number_format($p['preco'], 2, ',', '.') ?></div>
                <a href="/Projeto_ECommerce/web/views/Produto/produto.php?id=<?= $p['id'] ?>">
    <button class="btn-buy">Ver Produto</button>
</a>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
<!-- ==================== Hardware ==================== -->
    <h1 class="section-title mt-5">Hardware</h1>
    <div class="row g-4">

        <?php foreach ($pecas as $p): ?>
        <div class="col-6 col-sm-4 col-md-3">
            <div class="product-card">
                <div class="product-img">
                    <img src="<?= htmlspecialchars($p['img']) ?>" alt="">
                </div>
                <h5 class="product-title"><?= htmlspecialchars($p['nome']) ?></h5>
                <p class="product-desc"><?= htmlspecialchars($p['descricao']) ?></p>
                <div class="product-price preco-produto">R$ <?= number_format($p['preco'], 2, ',', '.') ?></div>
                <a href="/Projeto_ECommerce/web/views/Produto/produto.php?id=<?= $p['id'] ?>">
    <button class="btn-buy">Ver Produto</button>
</a>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
  
    <!-- FOOTER -->
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
