<?php
session_start();
require_once __DIR__ . '/../../app/repositores/Conecta.php';

$usuario_logado = isset($_SESSION['usuario_id']);
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header("Location: /Projeto_ECommerce/web/views/Login/Login.php");
    exit;
}
// pega o id do home
$id = $_GET['id'] ?? '';

if ($id == '' || !is_numeric($id)) {
    die("Produto inválido.");
}

// Buscar produto no banco (PDO)
try {
    $sql = $pdo->prepare("SELECT * FROM produto WHERE id = ?");
    $sql->execute([$id]);
    $produto = $sql->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar produto: " . $e->getMessage());
}

if (!$produto) {
    die("Produto não encontrado no banco!");
}
$produto_id = $id;
// Dados do produto
$nome        = $produto['nome']        ?? '';
$descricao   = $produto['descricao']   ?? '';
$preco       = $produto['preco']       ?? '';
$img         = $produto['img']         ?? '';
$img2        = $produto['img2'] ?? '';
$sku         = $produto['sku']         ?? '';


// ====================== PAGINAÇÃO ==========================
$pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$porPagina = 4;
$offset = ($pagina - 1) * $porPagina;

// TOTAL DE AVALIAÇÕES
$totalQuery = $pdo->prepare("
    SELECT COUNT(*) 
    FROM avaliacao 
    WHERE produto_id = :produto AND aprovado = 1
");
$totalQuery->execute([':produto' => $produto_id]);
$totalAvaliacoes = $totalQuery->fetchColumn();

$paginasTotais = ceil($totalAvaliacoes / $porPagina);

// BUSCAR AVALIAÇÕES DA PÁGINA
$sqlAvaliacao = $pdo->prepare("
    SELECT a.nota, a.comentario, u.nome
    FROM avaliacao a
    INNER JOIN usuarios u ON u.id = a.id_usuario
    WHERE a.produto_id = :produto AND a.aprovado = 1
    ORDER BY a.id DESC
    LIMIT :limite OFFSET :offset
");

$sqlAvaliacao->bindValue(':produto', $produto_id, PDO::PARAM_INT);
$sqlAvaliacao->bindValue(':limite', $porPagina, PDO::PARAM_INT);
$sqlAvaliacao->bindValue(':offset', $offset, PDO::PARAM_INT);

$sqlAvaliacao->execute();
$avaliacoes = $sqlAvaliacao->fetchAll(PDO::FETCH_ASSOC);
// Calcula média das avaliações
$mediaQuery = $pdo->prepare("
    SELECT AVG(nota) 
    FROM avaliacao 
    WHERE produto_id = :produto AND aprovado = 1
");
$mediaQuery->execute([':produto' => $produto_id]);
$media = floatval($mediaQuery->fetchColumn());
?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detalhes do Produto <?php echo $nome; ?></title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../public/css/produto.css">
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
 <!-- Produto -->
  <div class="container mt-5 text-white">

    <div class="row">
      <div class="col-md-6">

  <div id="carrosselProduto" class="carousel slide">

  <div class="carousel-inner">

    <div class="carousel-item active">
      <div class="carrossel-img-container">
        <img src="<?php echo $img; ?>" class="d-block w-100">
      </div>
    </div>

    <div class="carousel-item">
      <div class="carrossel-img-container">
        <img src="<?php echo $img2; ?>" class="d-block w-100">
      </div>
    </div>

  </div>

    <!-- BOTÕES -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carrosselProduto" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carrosselProduto" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>

  </div>

</div>


      <div class="col-md-6">
        <h2><?php echo $nome; ?></h2>

        <div class="mb-2">
    <?php 
    for ($i = 1; $i <= 5; $i++):
        if ($i <= floor($media)): ?>
            <i class="bi bi-star-fill estrela"></i>
        <?php elseif ($i - $media < 1): ?>
            <i class="bi bi-star-half estrela"></i>
        <?php else: ?>
            <i class="bi bi-star estrela-vazia"></i>
        <?php endif;
    endfor;
    ?>
    
    <span style="margin-left: 8px; font-size: 0.9rem; color: #ccc;">
        (<?= number_format($media, 1, ',', '.') ?> de 5 — <?= $totalAvaliacoes ?> avaliações)
    </span>
</div>

        <h4 class="preco-produto">R$  <?php echo number_format($preco, 2, ',', '.'); ?></h4>
        <p class="text-white">Produto Disponível</p>

        <a href="/Projeto_ECommerce/web/config/comprarAgora.php?id=<?php echo $id; ?>" 
   class="botao-produto botao-comprar">
   Comprar Agora
</a>

<a onclick="AddCarrinho(event)" 
   href="/Projeto_ECommerce/web/config/add_carrinho.php?id=<?php echo $produto['id']; ?>" 
   class="botao-produto botao-carrinho">
   Adicionar ao Carrinho
</a>
      </div>
    </div>

    <!-- Descrição -->
    <div class="mt-5">
      <h3 class="">Descrição do Produto: </h3>
      <p>
       <?php echo $descricao; ?>
      </p>
    </div><br>

    <!-- Avaliações -->

    <div class="avaliacoes mt-5">
    <h3 class="">Avaliações dos Usuários: </h3>

    <?php if (count($avaliacoes) > 0): ?>
        <?php foreach ($avaliacoes as $av): ?>
            <div class="avaliacao-card">
                
                <div class="avaliacao-usuario">
        <strong><?= htmlspecialchars($av['nome']) ?></strong>
    </div>
                <!-- Estrelas bonitas -->
                <div class="avaliacao-nota">
                    <?php for ($i = 1; $i <= 5; $i++): ?> 
                        <?php if ($i <= $av['nota']): ?>
                            <i class="bi bi-star-fill estrela"></i>
                        <?php else: ?>
                            <i class="bi bi-star estrela-vazia"></i>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>

                <p class="avaliacao-texto"><?= $av['comentario'] ?></p>
            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <p class="avaliacao-vazia">Nenhuma avaliação para este produto.</p>
    <?php endif; ?>
</div><br>

<!-- PAGINAÇÃO -->
<?php if ($paginasTotais > 1): ?>
<div class="paginacao">
    
    <!-- Botão voltar -->
    <?php if ($pagina > 1): ?>
        <a class="page-btn" 
           href="?id=<?= $produto_id ?>&pagina=<?= $pagina - 1 ?>">
           « Anterior
        </a>
    <?php endif; ?>

    <!-- Números das páginas -->
    <?php for ($i = 1; $i <= $paginasTotais; $i++): ?>
        <a class="page-number <?= $i == $pagina ? 'active' : '' ?>"
           href="?id=<?= $produto_id ?>&pagina=<?= $i ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <!-- Botão avançar -->
    <?php if ($pagina < $paginasTotais): ?>
        <a class="page-btn" 
           href="?id=<?= $produto_id ?>&pagina=<?= $pagina + 1 ?>">
           Próximo »
        </a>
    <?php endif; ?>

</div>
<?php endif; ?>
<h4>Avalie o produto:</h4>

<form action="/Projeto_ECommerce/web/config/addComenterio.php" method="POST">
    <input type="hidden" name="produto_id" value="<?= $produto_id ?>">
    <input type="hidden" name="nota" id="notaInput" required>

    <div class="rating" id="rating">
    <span class="star" data-value="1">&#9733;</span>
    <span class="star" data-value="2">&#9733;</span>
    <span class="star" data-value="3">&#9733;</span>
    <span class="star" data-value="4">&#9733;</span>
    <span class="star" data-value="5">&#9733;</span>
</div>

    <br>

    <label for="comentario">Comentário:</label>
    <textarea name="comentario" id="comentario" class="input-textarea" required></textarea>

    <button type="submit" class="btn-enviar">Enviar</button>
</form>


  <!-- Footer -->
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

  <div id="popupSucesso" class="popup-sucesso">
    <div class="icon-circle">
       <i class="bi bi-cart-check"></i>
    </div>

    <h2>Adicionado ao Carrinho</h2>

    <p>
        Aperte no no carrinho presente na navbar para a acessar seus produtos
    </p>
</div>
<script>
function AddCarrinho(e) {
    e.preventDefault(); // ❗ impede o reload instantâneo da página

    let url = e.target.href;
    let popup = document.getElementById("popupSucesso");

    // Envia o produto para o carrinho sem recarregar a página
    fetch(url)
      .then(res => {
           // Mostra o popup por 3 segundos
           popup.classList.add("show");
           setTimeout(() => {
               popup.classList.remove("show");
           }, 2000);
      })
      .catch(err => console.log("Erro ao adicionar:", err));
}
</script>

<script>
const stars = document.querySelectorAll(".star");
const notaInput = document.getElementById("notaInput");

// Quando clicar em uma estrela
stars.forEach(star => {
    star.addEventListener("click", () => {

        const value = parseInt(star.getAttribute("data-value"));
        notaInput.value = value; // registra nota no input escondido

        // Marca/desmarca as estrelas
        stars.forEach(s => {
            if (parseInt(s.getAttribute("data-value")) <= value) {
                s.classList.add("filled");
            } else {
                s.classList.remove("filled");
            }
        });

    });
});
</script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  
</body>

</html>
