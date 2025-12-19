<?php
session_start();

require_once __DIR__ . '/../../app/repositores/Conecta.php';
require __DIR__ . '/../../app/repositores/utils/cupom.php';
require __DIR__ . '/../../app/repositores/utils/usarCupom.php';



$usuario_logado = isset($_SESSION['usuario_id']);
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header("Location: /Projeto_ECommerce/web/views/Login/Login.php");
    exit;
}

// Verifica se existe carrinho
if (!isset($_SESSION['carrinho_id'])) {
    $itens = [];
} else {
    $carrinho_id = $_SESSION['carrinho_id'];

    // Buscar os itens do carrinho
    $sql = $pdo->prepare("
        SELECT 
               ci.quantidade,
               ci.preco_unitario,
               ci.produto_id,
               p.nome,
               p.img,
               p.preco
        FROM carrinhoitem ci
        INNER JOIN produto p ON p.id = ci.produto_id
        WHERE ci.carrinho_id = ?
    ");
    $sql->execute([$carrinho_id]);
    $itens = $sql->fetchAll(PDO::FETCH_ASSOC);
}
$subtotal = 0;

foreach ($itens as $item) {
    $subtotal += $item['preco_unitario'] * $item['quantidade'];
}

$total = $subtotal; // caso tenha frete depois, só adicionar
$pix = $subtotal * 0.85;
$card_parcela = $subtotal / 12;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">



    <link rel="stylesheet" href="/Projeto_ECommerce/web/public/css/carrinho.css">


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
    <div class="container my-5">

        <h2 class="text-white fw-semibold mb-4">Carrinho</h2>

        <div class="row">

            <!-- Lista de produtos -->
           <div class="col-lg-8">
    <div class="card text-white p-3 mb-3 pro">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="fw-semibold">Produto</span>

            <a href="/Projeto_ECommerce/web/config/limpar_carrinho.php" class="text-white text-decoration-none">
                LIMPAR CARRINHO
            </a>
        </div>

        <?php if (empty($itens)): ?>
            
            <p class="text-center">Seu carrinho está vazio.</p>

        <?php else: ?>

            <?php foreach ($itens as $item): ?>
                <div class="d-flex align-items-center p-3 rounded pro2">

                    <!-- Imagem -->
                    <div class="me-3">
                        <img src="<?= $item['img'] ?>" alt="<?= $item['nome'] ?>" class="img-produto">
                    </div>

                    <!-- Informações -->
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-semibold">
                            <?= $item['nome'] ?>
                        </p>

                        <small class="text-light">
                            Preço unitário:
                            <span class="fw-bold">R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?></span>
                        </small>
                        <br>
                        <small>ID: <?= $item['produto_id'] ?></small>
                    </div>

                    <!-- Quantidade -->
                    <div class="d-flex align-items-center ms-3">
                        <a href="/Projeto_ECommerce/web/config/atualizar_qtd.php?acao=menos&id=<?= $item['produto_id'] ?>" 
                           class="btn btn-outline-light btn-sm">-</a>

                        <input type="text" 
                               class="form-control text-center mx-2 qty-input"
                               value="<?= $item['quantidade'] ?>" style="width:45px;" disabled>

                        <a href="/Projeto_ECommerce/web/config/atualizar_qtd.php?acao=mais&id=<?= $item['produto_id'] ?>" 
                           class="btn btn-outline-light btn-sm">+</a>
                    </div>

                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>


            <!-- RESUMO DIREITA -->
 <div class="col-lg-4 col-md-12">

<div class="resumo-box">

  <h4 class="text-center mb-3" style="color: white;">Resumo</h4>

  <div class="linha" style="color: white;">
    <span>SubTotal</span>
    <span>R$ <?php echo number_format($subtotal, 2, ",", "."); ?></span>
  </div>
  <div class="linha" style="color: white;">
     <p class="valor-verde">Total:</p>
    <p class="valor-verde">R$ <?php echo number_format($subtotal, 2, ",", "."); ?></p>
  </div>

  <?php   $_SESSION['subtotal'] = $subtotal;
$_SESSION['total'] = $total;
$_SESSION['pix'] = $total * 0.85;
$_SESSION['parcelado'] = $total / 12;
?>
        <?php if ($usuario_logado): ?>
    <a href="/Projeto_ECommerce/web/views/Finalizar/finalizar.php" class="btn w-100 mt-4 py-2 fw-semibold b">
        FINALIZAR COMPRA
    </a>
<?php else: ?>
    <a href="/Projeto_ECommerce/web/views/Login/Login.php?msg=logar" class="btn w-100 mt-4 py-2 fw-semibold b">
        FAÇA LOGIN PARA COMPRAR
    </a>
<?php endif; ?>
        <a href="/Projeto_ECommerce/web/views/Home/home.php" class="btn btn-light w-100 mt-2 py-2 fw-semibold">CONTINUAR COMPRANDO</a>
</div>

</div>

</div>
</div>
      
     

    </div>

                </div>

            </div>

        </div>
    </div>
 

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

    <script src="/Projeto_ECommerce/web/public/js/enviarCupom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76A08GgCPSGdFN3tFz5b9dC0rY9FfN8Kp3RrZgWv5zF8Hk5j0k5L5W4nY1f3x4l"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.btn-plus').forEach((btn) => {
            btn.addEventListener('click', function() {
                const input = this.parentNode.querySelector('.qty-input');
                input.value = parseInt(input.value) + 1;
            });
        });

        document.querySelectorAll('.btn-minus').forEach((btn) => {
            btn.addEventListener('click', function() {
                const input = this.parentNode.querySelector('.qty-input');
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll('.btn-plus').forEach((btn) => {
            btn.addEventListener('click', function() {
                const input = this.parentNode.querySelector('.qty-input');
                input.value = parseInt(input.value) + 1;
            });
        });

        document.querySelectorAll('.btn-minus').forEach((btn) => {
            btn.addEventListener('click', function() {
                const input = this.parentNode.querySelector('.qty-input');
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                }
            });
        });
    </script>
</body>

</html>
