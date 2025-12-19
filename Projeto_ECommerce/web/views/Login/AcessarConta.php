<?php
session_start();

// Verifica se veio erro via GET
$mensagem = "";
if (isset($_GET['erro'])) {
    if ($_GET['erro'] == 1) {
        $mensagem = "<div class='alert alert-danger text-center mt-3'>Email ou senha incorretos.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Acessar Conta</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../public/css/AcessarConta.css">
</head>

<body>
<nav class="navbar border-bottom border-body" data-bs-theme="dark" id="nav">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Projeto_ECommerce/web/views/Home/home.php">Bit<span id="up">UP</span></a>
    </div>
</nav><br>

<div class="container-fluid" id="acesse">
    <div>
        <h1>Acessar conta</h1>

        <form action="/Projeto_ECommerce/web/views/Login/validarLogin.php" method="post">
            <div class="input-box">
                <input required type="text" class="input" id="email" name="email">
                <label class="label" for="email">
                    <span class="char" style="--index:0;padding-left:5px;">E</span>
                    <span class="char" style="--index:1;">m</span>
                    <span class="char" style="--index:2;">a</span>
                    <span class="char" style="--index:3;">i</span>
                    <span class="char" style="--index:4;padding-right:5px;">l</span>
                </label>
            </div>

            <div class="input-box">
                <input required type="password" class="input" id="senha" name="senha">
                <label class="label" for="senha">
                    <span class="char" style="--index:0;padding-left:5px;">S</span>
                    <span class="char" style="--index:1;">e</span>
                    <span class="char" style="--index:2;">n</span>
                    <span class="char" style="--index:3;">h</span>
                    <span class="char" style="--index:4;padding-right:5px;">a</span>
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkSenha">
                <label class="form-check-label" for="checkSenha">Mostrar senha</label>
            </div>

            <button type="submit" class="btn b">Entrar</button>
        </form>

        <?= $mensagem ?>
    </div>
</div>

<script>
const senhaInput = document.getElementById("senha");
const check = document.getElementById("checkSenha");

check.addEventListener("change", () => {
    senhaInput.type = check.checked ? "text" : "password";
});
</script>

</body>
</html>

