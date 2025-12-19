<?php

require_once __DIR__ . "/../../app/repositores/Conecta.php"; 
// Agora usamos $pdo no lugar de $conn (MySQLi)

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST["nome"] ?? '';
    $email = $_POST["email"] ?? '';
    $senha = $_POST["senha"] ?? '';
    $telefone = $_POST["telefone"] ?? '';

    // 🔹 Verifica se o email já existe (PDO)
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {

        $mensagem = "<div class='alert alert-warning text-center mt-3'>
                        Email já cadastrado.
                     </div>";

    } else {

        // 🔹 Criptografar senha
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
        $tipo = "cliente";

        // 🔹 Inserir novo usuário (PDO)
        $stmt = $pdo->prepare("
            INSERT INTO usuarios (nome, email, senha, telefone, tipo) 
            VALUES (?, ?, ?, ?, ?)
        ");

        if ($stmt->execute([$nome, $email, $senhaCriptografada, $telefone, $tipo])) {

            $mensagem = "<div class='alert alert-success text-center mt-3'>
                            Cadastro realizado com sucesso! <br> Redirecionando para o login...
                         </div>";

            $redirecionar = true;

        } else {
            $mensagem = "<div class='alert alert-danger text-center mt-3'>
                            Erro ao cadastrar.
                         </div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../..//public/css/Cadastrar.css">
</head>
<body>

    <nav class="navbar border-bottom border-body" data-bs-theme="dark" id="nav">
        <div class="container-fluid">
          <a class="navbar-brand" href="/Projeto_ECommerce/web/views/Home/home.php">Bit<span id="up">UP</span></a>
        </div>
    </nav><br>

    <div class="container-fluid" id="acesse">
        <div>
          <h1>Cadastre-se</h1>

          <form action="" method="post">

            <div class="input-box">
              <input required type="text" class="input" id="nome" name="nome" placeholder="">
              <label class="label" for="nome">
                <span class="char" style="--index: 0; padding-left: 5px;">N</span>
                <span class="char" style="--index: 1">o</span>
                <span class="char" style="--index: 2">m</span>
                <span class="char" style="--index: 3; padding-right: 5px;">e</span>
              </label>
            </div>

            <div class="input-box">
              <input required type="text" class="input" id="email" name="email" placeholder="">
              <label class="label" for="email">
                <span class="char" style="--index: 0; padding-left: 5px;">E</span>
                <span class="char" style="--index: 1">m</span>
                <span class="char" style="--index: 2">a</span>
                <span class="char" style="--index: 3">i</span>
                <span class="char" style="--index: 4; padding-right: 5px;">l</span>
              </label>
            </div>

            <div class="input-box">
                <input required type="password" class="input" id="senha" name="senha" placeholder="">
                <label class="label" for="senha">
                  <span class="char" style="--index: 0; padding-left: 5px;">S</span>
                  <span class="char" style="--index: 1">e</span>
                  <span class="char" style="--index: 2">n</span>
                  <span class="char" style="--index: 3">h</span>
                  <span class="char" style="--index: 4; padding-right: 5px;">a</span>
                </label>
              </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="checkSenha">
              <label class="form-check-label" for="checkSenha">
                Mostrar senha
              </label>
            </div>

            <div class="input-box">
                <input required type="tel" class="input" id="telefone" maxlength="11" name="telefone" placeholder="">
                <label class="label" for="telefone">
                  <span class="char" style="--index: 0; padding-left: 5px;">T</span>
                  <span class="char" style="--index: 1">e</span>
                  <span class="char" style="--index: 2">l</span>
                  <span class="char" style="--index: 3">e</span>
                  <span class="char" style="--index: 4">f</span>
                  <span class="char" style="--index: 5">o</span>
                  <span class="char" style="--index: 6">n</span>
                  <span class="char" style="--index: 7; padding-right: 5px;">e</span>
                </label>
            </div>

            <button type="submit" class="btn b">Cadastrar</button>
            <?php if (!empty($mensagem)) echo $mensagem; ?>
          </form>
        </div>

        <script>
          const senhaInput = document.getElementById("senha");
          const check = document.getElementById("checkSenha");

          check.addEventListener("change", () => {
            senhaInput.type = check.checked ? "text" : "password";
          });
        </script>
      <script>
  const form = document.querySelector("form");
  const emailInput = document.getElementById("email");
  const telefoneInput = document.getElementById("telefone");

  const mensagemDiv = document.createElement("div");
  mensagemDiv.classList.add("mt-3");
  form.appendChild(mensagemDiv);

  function mostrarMensagem(tipo, texto) {
    mensagemDiv.innerHTML = `
      <div class="alert alert-${tipo} text-center">${texto}</div>
    `;
  }

  form.addEventListener("submit", function (event) {

    mensagemDiv.innerHTML = ""; // limpa antes

    // ====== VALIDAR EMAIL ======
    if (!emailInput.value.includes("@")) {
      event.preventDefault();
      mostrarMensagem("danger", "O email precisa conter '@'.");
      return;
    }

    // ====== VALIDAR TELEFONE ======
    const telefone = telefoneInput.value;

    if (!/^[0-9]{11}$/.test(telefone)) {
      event.preventDefault();
      mostrarMensagem("danger", "O telefone deve conter exatamente 11 números (DDD + número). Exemplo: 11987654321");
      return;
    }

  });
</script>
<?php if (isset($redirecionar) && $redirecionar): ?>
<script>
setTimeout(() => {
    window.location.href = "AcessarConta.php"; // caminho da sua página de login
}, 1500); // 1,5 segundos
</script>
<?php endif; ?>


</body>
</html>

