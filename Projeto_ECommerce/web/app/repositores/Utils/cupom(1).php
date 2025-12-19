<?php
function validarCupom($codigo, $pdo) {
    $sql = $pdo->prepare("SELECT * FROM cupom WHERE codigo = ? AND ativo = 1 AND NOW() BETWEEN valido_de AND valido_ate");
    $sql->execute([$codigo]);
    return $sql->fetch(PDO::FETCH_ASSOC);
}