<?php
session_start(); 
 require_once __DIR__ . '/../../app/repositores/Conecta.php'; 
require_once __DIR__ . '/../../config/aplicar_cupom.php'; 
// ✔ Se for compra direta, limpar totais antigos APENAS na primeira carga
if (isset($_GET['compra']) && $_GET['compra'] === 'agora' && !isset($_POST['aplicar'])) {
    unset($_SESSION['subtotal']);
    unset($_SESSION['total']);
    unset($_SESSION['descontos']);
}

// ✔ Carregar valores da sessão normalmente
$subtotal = $_SESSION['subtotal'] ?? 0;
$total = $_SESSION['total'] ?? $subtotal;
$descontos = $_SESSION['descontos'] ?? 0;

// ✔ Ajuste correto para compra direta — SEM sobrescrever o total do cupom
if (isset($_GET['compra']) && $_GET['compra'] === 'agora' && isset($_SESSION['compra_direta'])) {
    $produto = $_SESSION['compra_direta'];
    $subtotal = $produto['subtotal'];

    // ⚠️ IMPORTANTE: só usar total da compra direta SE o cupom ainda não foi aplicado
    if (!isset($_SESSION['descontos'])) {
        $total = $produto['total'];
    }
}

// ✔ Se cupom foi aplicado, garantir que o total seja o da sessão
$total = $_SESSION['total'] ?? $total;
$descontos = $_SESSION['descontos'] ?? 0;

          // Verifica login 
          if (!isset($_SESSION['usuario_id'])) { header("Location: /Projeto_ECommerce/web/views/Login/Login.php"); exit; }
          // Carrega nome do usuário (se ainda não estiver carregado)
           if (!isset($_SESSION['usuario_nome'])) { $id = $_SESSION['usuario_id'];
             $stmt = $pdo->prepare("SELECT nome FROM usuarios WHERE id = ?"); 
             $stmt->execute([$id]); 
             $u = $stmt->fetch(PDO::FETCH_ASSOC); 
             if ($u) { $_SESSION['usuario_nome'] = $u['nome']; } } 
             // Daqui pra frente: HTML da página Finalizar Compra
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finalizar Pedido</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../public/css/finalizar.css">
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
  <div class="container mt-4">

    <div class="row">

      <!-- FORMULÁRIO ESQUERDA -->
      <div class="col-lg-6 col-md-12">

        <h1 class="branco mb-4">Finalize o seu pedido</h1>

        <h4 class="branco">Informações pessoais</h4>

        <form id="form1">

          <div class="row g-3 mt-1">

            <div class="col-md-6 col-12">
              <input type="text" name="nome" id="final_nome" class="form-control"  placeholder="Nome Completo" required>
            </div>

            <div class="col-md-6 col-12">
              <input type="text" name="cpf"  id="final_cpf" class="form-control" placeholder="CPF" required>
            </div>

            <div class="col-md-6 col-12">
              <input type="email" name="email" id="final_email" class="form-control" placeholder="Email" required>
            </div>

            <div class="col-md-6 col-12">
              <input type="text" name="telefone" id="final_telefone" class="form-control" placeholder="Num. Telefone" required>
            </div>
            <div class="col-md-12 col-12">
             
            </div>

          </div>

        </form>


        <h4 class="branco mt-4">Adicionar endereço</h4>

        <form id="form2">

          <div class="row g-3 mt-1">

            <div class="col-12">
              <input type="text" name="cep" id="final_cep" class="form-control" placeholder="CEP" required>
            </div>

            <div class="col-md-8 col-12">
              <input type="text" name="endereco" id="final_endereco" class="form-control" placeholder="Endereço (Rua,Avenida...)" required>
            </div>

            <div class="col-md-4 col-12">
              <input type="text" name="numero" id="final_numero" class="form-control" placeholder="Número" required>
            </div>

            <div class="col-md-6 col-12">
              <input type="text" name="bairro" id="final_bairro" class="form-control" placeholder="Bairro" required>
            </div>

            <div class="col-md-6 col-12">
              <input type="text" name="complemento" id="final_complemento" class="form-control" placeholder="Complemento" required>
            </div>

            <div class="col-md-6 col-12">
              <input type="text" name="estado" onblur="validarEstado()"  id="final_estado" oninput="this.value = this.value.toUpperCase().replace(/[0-9]/g, '')" maxlength="2" class="form-control" placeholder="Estado/Sigla" required>
       <small id="erro_estado" style="color: red; display: none;"></small>
            </div>

            <div class="col-md-6 col-12">
              <input type="text" name="cidade" id="final_cidade" class="form-control" placeholder="Cidade" required>
            </div>
            <div class="col-md-12 col-12">
              
            </div>
          </div>

        </form>

      </div>


      <!-- RESUMO DIREITA -->
      <div class="col-lg-5 offset-lg-1 col-md-12 mt-5 mt-lg-0">
          <div class="resumo-box">

            <h4 class="text-center mb-3 text-white">Cupom</h4>

            <div class="linha text-white">
              <span>SubTotal:</span>
              <span><?php echo "R$ " . number_format($subtotal, 2, ",", "."); ?></span>
            </div>

            <form method="POST">

              <label for="cupom" class="text-white">Cupom de desconto:</label>

              <div class="input-group mb-2">
                <input type="text" name="cupom" id="cupom" class="form-control" placeholder="DIGITE O CUPOM">
                <button type="submit" name="aplicar" class="btn btn-primary">Aplicar</button>
              </div>

          <div id="msgCupom">
    <?php echo $mensagem ?? ''; ?>
</div>


            </form>
<?php 
if (isset($_POST['aplicar']) && $descontos > 0) { 
?>
    <p class="vista" id="msgEconomia">
        Você economizou
        <strong><?php echo "R$ " . number_format($descontos, 2, ",", "."); ?></strong>
    </p>
<?php 
} 
?>


          </div><br>

        <div class="resumo-box">

          <h4 class="text-center mb-3" style="color: white;">Valor</h4>
          <hr style="color:#fff;">

          <div class="linha">
            <p class="branco">Subtotal:</p>
            <p class="branco">R$ <?php echo number_format($subtotal, 2, ",", "."); ?></p>
          </div>

          <div class="linha">
            <p class="valor-verde">Total:</p>
            <p class="valor-verde">R$ <?php echo number_format($total, 2, ',', '.') ?></p>
          </div>
        
        </div>
      </div>

    </div>
  </div>



  <div class="container mt-5">

    <h3 class="text-white mt-4">Método de Pagamento</h3>

    <div class="accordion mt-3" id="accordionPagamento">

      <!-- CARTÃO DE CRÉDITO -->
      <div class="accordion-item bg-dark text-white">
        <h2 class="accordion-header">
          <button class="accordion-button metodo text-white collapsed" data-metodo="credito" style="background-color: #353434 ;" type="button" data-bs-toggle="collapse"
            data-bs-target="#credito">
            Cartão de Crédito
          </button>
        </h2>

        <div id="credito" class="accordion-collapse collapse" data-bs-parent="#accordionPagamento">
          <div class="accordion-body">

            <form id="form3">
              <div class="row mb-3">
                <div class="col-md-10 col-12 mb-2">
                  <input type="text" name="numcartao" class="form-control mb-3" placeholder="Número do Cartão" maxlength="19" required>
                </div>
                <div class="col-md-2 col-12 mb-2">
                  <input type="text" name="cvv" class="form-control mb-3" placeholder="CVV" maxlength="4" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6 col-12 mb-2">
                  <input type="text" name="mes" class="form-control" placeholder="Mês Validade" maxlength="2" required>
                </div>
                <div class="col-md-6 col-12">
                  <input type="text" name="ano" class="form-control" placeholder="Ano Validade" maxlength="4" required>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-8 col-12 mb-2">
                  <input type="text" name="titular" class="form-control" placeholder="Nome do Titular" required>
                </div>
                <div class="col-md-4 col-12">
                  <input type="text" name="cpf2" class="form-control" placeholder="CPF" maxlength="14" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-12 col-12">
                  <select class="form-select mb-3" required>
                    <option disabled selected>Parcelas</option>
                    <?php for ($x = 1; $x <= 12; $x++) echo "<option>$x x</option>"; ?>
                  </select>
                </div>
              </div>
              
            </form>

          </div>
        </div>
      </div>

      <!-- CARTÃO DE DÉBITO -->
      <div class="accordion-item bg-dark text-white mt-3">
        <h2 class="accordion-header">
          <button class="accordion-button metodo text-white collapsed" data-metodo="debito" style="background-color: #353434 ;" type="button" data-bs-toggle="collapse"
            data-bs-target="#debito">
            Cartão de Débito
          </button>
        </h2>

        <div id="debito" class="accordion-collapse collapse" data-bs-parent="#accordionPagamento">
          <div class="accordion-body">

            <form id="form4">
              <div class="row mb-3">
                <div class="col-md-10 col-12 mb-2">
                  <input type="text" name="numcartao" class="form-control mb-3" placeholder="Número do Cartão" maxlength="19" required>
                </div>
                <div class="col-md-2 col-12 mb-2">
                  <input type="text" name="cvv" class="form-control mb-3" placeholder="CVV" maxlength="4" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6 col-12 mb-2">
                  <input type="text" name="mes" class="form-control" placeholder="Mês Validade" maxlength="2" required>
                </div>
                <div class="col-md-6 col-12">
                  <input type="text" name="ano" class="form-control" placeholder="Ano Validade" maxlength="4" required>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-8 col-12 mb-2">
                  <input type="text" name="titular" class="form-control" placeholder="Nome do Titular" required>
                </div>
                <div class="col-md-4 col-12">
                  <input type="text" name="cpf2" class="form-control" placeholder="CPF" maxlength="14" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-12 col-12">
                  <select class="form-select mb-3" required>
                    <option disabled selected>Parcelas</option>
                    <?php for ($x = 1; $x <= 12; $x++) echo "<option>$x x</option>"; ?>
                  </select>
                </div>
              </div>

   
            </form>

          </div>
        </div>
      </div>
<small id="erro_pagamento" style="color: red; display: none; font-size: 14px;"></small>
    </div>


<!--Formulario invisivel q pega os valores e manda para historico-->
    <form id="final" action="/Projeto_ECommerce/web/config/processarPedido.php" method="POST">

    <input type="hidden" name="nome" id="h_nome" required>
    <input type="hidden" name="cpf" id="h_cpf" required>
    <input type="hidden" name="email" id="h_email" required>
    <input type="hidden" name="telefone" id="h_telefone" required>

    <input type="hidden" name="cep" id="h_cep" required>
    <input type="hidden" name="endereco" id="h_endereco" required>
    <input type="hidden" name="numero" id="h_numero" required>
    <input type="hidden" name="bairro" id="h_bairro" required>
    <input type="hidden" name="complemento" id="h_complemento" required>
    <input type="hidden" name="estado" id="h_estado" required>
    <input type="hidden" name="cidade" id="h_cidade" required>

    <input type="hidden" name="subtotal" value="<?= $subtotal ?>" required>
    <input type="hidden" name="frete" value="<?= $frete ?>" required>
    <input type="hidden" name="total" value="<?= $total ?>" required>

    <input type="hidden" name="tipo_pagamento" id="tipo_pagamento" required>
    <!-- BOTÃO FINAL -->
      <button type="submit" id="salvarTudo" class="btn btn-primary w-100 mt-4">
        Salvar e Ver Detalhes da Entrega
      </button>
</form>
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

    </div>
</footer>


<script src="/Projeto_ECommerce/web/public/js/apagar_msg.js">

</script>


<script src="/Projeto_ECommerce/web/public/js/preencherTudo.js"></script>
<script src="/Projeto_ECommerce/web/public/js/validarPagmento.js"></script>
  
<script src="/Projeto_ECommerce/web/public/js/tudo.js"></script>

<script src="/Projeto_ECommerce/web/public/js/validarEstado.js"></script>

  <script src="/Projeto_ECommerce/web/public/js/salvar.js"></script>
  <!-- Script que permite fechar ao clicar novamente -->
  <script src="/Projeto_ECommerce/web/public/js/baixo.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/Projeto_ECommerce/web/public/js/java.js"></script>
</body>

</html>