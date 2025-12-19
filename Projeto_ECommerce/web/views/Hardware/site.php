<?php
require_once __DIR__ . '/../../app/repositores/Conecta.php';

$sql = "SELECT id, nome, preco FROM produto ORDER BY id DESC";
$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Minha Loja — Modernizada</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Fonte -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>


<body>

<!-- TOPBAR / NAV -->
<header class="site-topbar">
  <nav class="navbar navbar-expand-lg">
    <div class="container d-flex align-items-center">

      <!-- LOGO -->
      <a class="navbar-brand me-2" href="#"><span class="brand-accent">K</span> minha-loja</a>

      <!-- BOTÃO CEP (ao lado do logo) -->
    
      <!-- Toggler (mobile) -->
      <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navSearch" aria-controls="navSearch" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- SEARCH -->
      <div class="collapse navbar-collapse flex-grow-1" id="navSearch">
        <form class="d-flex w-100 align-items-center" role="search" onsubmit="return false;">
          <div class="input-group w-100">
            <input id="navbarSearchInput" type="search" class="form-control" placeholder="Buscar por nome, modelo ou fabricante">
            <button id="navbarSearchBtn" type="button" class="btn" style="background:var(--accent); color:#071025;">
              <i class="bi bi-search"></i> Buscar
            </button>
          </div>

          <!-- CARRINHO E LOGIN (após buscar) -->
          <div class="d-flex align-items-center ms-3 gap-2">
            <button class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#cartModal" title="Carrinho">
              <i class="bi bi-cart-fill"></i>
            </button>
            <button class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#loginModal" title="Login">
              <i class="bi bi-person-fill"></i>
            </button>
          </div>
        </form>
      </div>

    </div>
  </nav>
</header>


<!-- Links secundários -->
<div class="menu-links text-center mb-3">
  <a href="#">Home</a> •
  <a href="#">Produtos</a> •
  <a href="#">Contato</a>
</div>

<!-- HERO -->
<div class="container">
  <div class="hero mb-4">
    <img src="https://via.placeholder.com/1200x300/0E2B4B/FFFFFF?text=Promoções+Imperdíveis" alt="Banner">
  </div>
</div>

<!-- CONTENT -->
<div class="container mb-5">
  <div class="row gx-4">

    <!-- SIDEBAR DESKTOP -->
    <aside class="col-lg-3 d-none d-lg-block">
      <div class="filter-card" id="desktopFilters"></div>
    </aside>

    <!-- OFFCANVAS MOBILE FILTERS -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="filterMenu" aria-labelledby="filterMenuLabel">
      <div class="offcanvas-header">
        <h5 id="filterMenuLabel">Filtros</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
      </div>
      <div class="offcanvas-body">
        <div class="filter-card" id="mobileFilters"></div>
      </div>
    </div>

    <!-- PRODUTOS -->
    <main class="col-12 col-lg-9">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="muted-small">Exibindo <span id="visibleCount">—</span> produtos</div>
        <div>
          <select id="sortSelect" class="form-select form-select-sm" style="width:220px">
            <option value="default">Ordenar: Relevância</option>
            <option value="price-asc">Preço: menor → maior</option>
            <option value="price-desc">Preço: maior → menor</option>
            <option value="name-asc">Nome A → Z</option>
          </select>
        </div>
      </div>

      <div class="row g-4" id="productList">

      <div class="container py-4">
  <div class="row g-4" id="productList">
  <?php
// ==============================
//  CONEXÃO COM O BANCO
// ==============================
require_once __DIR__ . '/../../app/repositores/Conecta.php';

// Consulta todos os produtos
$sql = "SELECT * FROM produto ORDER BY id DESC";
$stmt = $pdo->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container py-4">
    
    <h1 class="mb-4">Produtos</h1>

    <!-- GRID DE PRODUTOS -->
    <div class="row g-4" id="productList">

<?php

// ==============================
//  VERIFICA SE EXISTEM PRODUTOS
// ==============================
if ($result->num_rows > 0) {

    // Loop para exibir cada produto
    while ($p = $result->fetch_assoc()) {

        // ------------------------------
        //  PREPARAÇÃO DE VALORES SEGUROS
        // ------------------------------
        $nome      = $p['nome']      ?? 'Produto sem nome';
        $descricao = $p['descricao'] ?? '';
        $preco     = isset($p['preco']) ? number_format($p['preco'], 0, ',', '.') : '0';

        // Se não tiver imagem → usa padrao.jpg
        $imagem = (!empty($p['imagem'])) ? $p['imagem'] : 'padrao.jpg';

        // Categoria (exemplo simples)
        $categoria = $p['categoria'] ?? 'outros';

        // Badge da categoria
        switch (strtolower($categoria)) {
            case 'ssd':
                $badge = '<span class="badge-cat">SSD</span>';
                break;

            case 'placa-mae':
                $badge = '<span class="badge-cat" style="background:linear-gradient(90deg,#1f6feb,#0ea5ff);">MB</span>';
                break;

            case 'gpu':
                $badge = '<span class="badge-cat" style="background:linear-gradient(90deg,#8b2cff,#ff6fb5);">GPU</span>';
                break;

            case 'ram':
                $badge = '<span class="badge-cat" style="background:linear-gradient(90deg,#06b6d4,#67e8f9);">RAM</span>';
                break;

            default:
                $badge = '<span class="badge-cat">OUTROS</span>';
        }

        // ==============================
        //  CARD DO PRODUTO
        // ==============================
        ?>

        <div class="col-md-6 col-lg-4 product-col product"
             data-name="<?= htmlspecialchars($nome) ?>"
             data-price="<?= $preco ?>"
             data-category="<?= htmlspecialchars($categoria) ?>">

            <div class="product-card">
                
                <!-- Badge da categoria -->
                <?= $badge; ?>

                <!-- IMAGEM DO PRODUTO -->
                <!-- Busca em /imagens/ -->
                <img src="public/img/<?= htmlspecialchars($imagem) ?>"
                     alt="<?= htmlspecialchars($nome) ?>">

                <!-- Título -->
                <div class="product-title"><?= htmlspecialchars($nome) ?></div>

                <!-- Descrição curta -->
                <div class="muted-small"><?= htmlspecialchars($descricao) ?></div>

                <!-- Preço formatado -->
                <div class="product-price">R$ <?= $preco ?></div>

            </div>
        </div>

        <?php
        // fim do loop while
    }

} else {

    // ==============================
    //  CASO NÃO EXISTA NENHUM PRODUTO
    // ==============================
    echo "<p class='text-muted'>Nenhum produto encontrado.</p>";
}

// Fecha a conexão
$conn->close();
?>

    </div> <!-- fim .row -->
</div> <!-- fim container -->


</div>

</div>


      <!-- mensagem nenhum produto -->
      <div id="noProductsPlaceholder"></div>

      <!-- PAGINAÇÃO -->
      <nav aria-label="Paginação" class="mt-4 d-flex justify-content-center">
    <ul class="pagination">

        <!-- voltar -->
        

    </ul>
</nav>


  </div>
</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- SCRIPTS: filtros + sincronização + ordenação -->
 <script src="type.js"></script>
</body>
</html>
