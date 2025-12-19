<?php
// Lista de fretes por estado (UF)
$fretes_estado = [
    "AC" => 39.90, "AL" => 34.90, "AP" => 42.90, "AM" => 49.90,
    "BA" => 29.90, "CE" => 27.90, "DF" => 19.90, "ES" => 24.90,
    "GO" => 22.90, "MA" => 31.90, "MT" => 32.90, "MS" => 33.90,
    "MG" => 21.90, "PA" => 44.90, "PB" => 26.90, "PR" => 18.90,
    "PE" => 25.90, "PI" => 30.90, "RJ" => 15.90, "RN" => 28.90,
    "RS" => 17.90, "RO" => 45.90, "RR" => 46.90, "SC" => 16.90,
    "SP" => 12.90, "SE" => 29.90, "TO" => 35.90
];

// Verifica se enviou algo
if (!isset($_POST['estado'])) {
    echo "Nenhum estado informado.";
    exit;
}

// Limpa e padroniza o dado
$estado = strtoupper(trim($_POST['estado']));

if (array_key_exists($estado, $fretes_estado)) {
    $frete = number_format($fretes_estado[$estado], 2, ',', '.');
    echo "<h3>Frete para $estado: <strong>R$ $frete</strong></h3>";
} else {
    echo "<h3 style='color:red;'>Estado inválido ou não encontrado.</h3>";
}
?>
