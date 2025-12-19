<?php
session_start();

require_once __DIR__ . '/../app/repositores/Conecta.php';
require_once __DIR__ . '/../app/repositores/utils/cupom.php';
require_once __DIR__ . '/../app/repositores/utils/usarCupom.php';

$cupom = $_POST['cupom'] ?? '';

$subtotal = 0;
if (isset($_SESSION['carrinhoitem'])) {
    foreach ($_SESSION['carrinhoitem'] as $item) {
        $subtotal += $item['preco'] * $item['quantidade'];
    }
}

$resultado = aplicarCupom($subtotal, $cupom, $pdo);

if (!empty($resultado['msgErro'])) {
    echo json_encode([
        'erro' => $resultado['msgErro']
    ]);
    exit;
}

echo json_encode([
    'total' => number_format($resultado['total'], 2, ',', '.'),
    'pix' => number_format($resultado['total'] * 0.85, 2, ',', '.'),
    'parcelado' => number_format($resultado['total'] / 12, 2, ',', '.')
]);

