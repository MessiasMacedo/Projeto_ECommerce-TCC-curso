<?php
session_start();

require_once __DIR__ . '/../../app/repositores/Conecta.php';
require __DIR__ . '/../../config/historico.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /Projeto_ECommerce/web/views/Login/Login.php");
    exit;
}
$parcelas = $total / 12;  // AGORA funciona
// Buscar itens do pedido
$idPedido = $_GET['id'] ?? 0;

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">



    <link rel="stylesheet" href="../../public/css/fim.css">


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


    <div class="container my-12">
        <h1 class="lado">Finalize seu pedido</h1>
        <h5 class="lado">Revise seu pedido e finalize</h5>
        <br>
        <div class="row g-1">

            <!-- COLUNA ESQUERDA: REVISÃO -->
            <div class="col-lg-6">



                <!-- REVISAR PEDIDO (ABAIXO DO PRODUTO) -->
                <div class="mt-4 p-4" style="background:#2f2f2f; border-radius:8px; color:white;">

                    <div class="row">
                        <!-- Meus Dados -->
                        <div class="section mb-4">
                            <div class="section">
                                <h2>Meus Dados</h2>
                            </div>
                            <br>
                            <p>NOME: <?= $nome ?> (<?= $email ?>)</p>
                            <p>CPF: <?= $cpf ?></p>
                        </div>
                    </div>

                    <!-- Entrega + Pagamento -->
                    <div class="row section">

                        <div class="col-md-5">
                            <h2>Entrega</h2>
                            <p>Destinatário: <?= $destinatario ?></p>
                            <p>Endereço:<?= $endereco ?></p>
                            <p><?= $bairro ?> - <?= $cidade ?>/<?= $estado ?></p>
                            <p>CEP: <?= $cep ?></p>
                        </div>

                    </div>

                </div>

            </div>

            <!-- COLUNA DIREITA: RESUMO -->
            <div class="col-lg-5 col-md-6">
                <div class="resumo-box">

                    <h4 class="text-center mb-3" style="color: white;">Pagamento</h4>

                    <div class="linha" style="color: white;">
                        <span>Tipo de pagamento:</span>
                        <span> <?= $metodo_pagamento ?></span>

                    </div>
                

                    <div class="linha">
                    <span>Frete:</span>
                    <span> R$ <?= number_format($frete, 2, ',', '.') ?></span>
                    </div>

                    <div class="linha">
                        <p class="valor-verde">Total:</p>
                        <p class="valor-verde">R$ <?php echo number_format($total, 2, ",", "."); ?></p>
                    </div>

                    

                    <div class="texto-centro mt-3">
                        <button onclick="finalizarCompra()" class="btn w-100 mt-4 py-2 fw-semibold b">
                            FINALIZAR COMPRA
                        </button>
                        <a href="../../views/Home/home.php" class="btn btn-light w-100 mt-2 py-2 fw-semibold">
                            CONTINUAR COMPRANDO
                        </a>
                    </div>


                </div>

            </div>

        </div>

    </div>
    </div>

<!--Coisa que so aparece  qnd finaliza-->
    <div id="popupSucesso" class="popup-sucesso">
        <div class="icon-circle">
            <i class="bi bi-check-lg"></i>
        </div>

        <h2>Compra realizada com sucesso!</h2>

        <p>
            Muito Obrigado <?php echo $nome; ?><br>
            Por realizar a compra conosco<br>
            Sua compra foi realizada, Muito Obrigado.
        </p>
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
    <script>
        function finalizarCompra() {
            let popup = document.getElementById("popupSucesso");

            // Mostra o popup
            popup.style.display = "block";

             // Limpa o carrinho no backend
    fetch("/Projeto_ECommerce/web/config/limpar_carrinho.php", {
        method: "POST"
    }).then(() => {
        // Depois de limpar, espera um pouquinho e vai para home
        setTimeout(() => {
            window.location.href = "/Projeto_ECommerce/web/views/Home/home.php";
        }, 1500);
    });
}
    </script>


    <script src="/Projeto_ECommerce/web/public/js/aumentar.js"></script>
    <script src="/Projeto_ECommerce/web/public/js/java.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>