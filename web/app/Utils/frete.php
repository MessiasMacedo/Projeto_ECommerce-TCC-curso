<?php
function frete($estado) {
    // Tabela de fretes por estado
    $fretes = [
        "AC" => 39.90,
        "AL" => 34.90,
        "AP" => 42.90,
        "AM" => 49.90,
        "BA" => 29.90,
        "CE" => 27.90,
        "DF" => 19.90,
        "ES" => 24.90,
        "GO" => 22.90,
        "MA" => 31.90,
        "MT" => 32.90,
        "MS" => 33.90,
        "MG" => 21.90,
        "PA" => 44.90,
        "PB" => 26.90,
        "PR" => 18.90,
        "PE" => 25.90,
        "PI" => 30.90,
        "RJ" => 15.90,
        "RN" => 28.90,
        "RS" => 17.90,
        "RO" => 45.90,
        "RR" => 46.90,
        "SC" => 16.90,
        "SP" => 12.90,
        "SE" => 29.90,
        "TO" => 35.90
    ];

    // Retorna o frete do estado ou 0 caso não encontre
    return $fretes[$estado] ?? 0;
}
