<?php
function aplicarCupom($subtotal, $codigo_cupom, $pdo) {
    $total = $subtotal;
    $pix = $subtotal * 0.85;
    $parcelado = $subtotal / 12;
    $msgErro = '';

    if (!empty($codigo_cupom)) {
        $cupom = validarCupom($codigo_cupom, $pdo);
        if ($cupom) {
            if ($cupom['tipo'] === 'percentual') {
                $desconto = $subtotal * ($cupom['valor'] / 100);
            } else { // fixo
                $desconto = $cupom['valor'];
            }
            $total = max(0, $subtotal - $desconto);
            $pix = $total * 0.85;
            $parcelado = $total / 12;
        } else {
            $msgErro = "Cupom inválido ou expirado.";
        }
    }

    return [
        'total' => $total,
        'parcelado' => $parcelado,
        'msgErro' => $msgErro
    ];
}
?>