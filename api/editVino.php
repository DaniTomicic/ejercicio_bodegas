<?php
// Recibe JSON por POST y actualiza el vino en la BD
header('Content-Type: application/json');
require_once __DIR__ . '/../Models/Vino.php';
require_once __DIR__ . '/../Models/DB/VinoDB.php';

use Models\Vino;
use Models\DB\VinoDB;

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'No se recibió JSON válido']);
    exit;
}

// Validación mínima
if (!isset($data['idVino'], $data['idBodega'])) {
    http_response_code(422);
    echo json_encode(['error' => 'Faltan campos obligatorios: idVino o idBodega']);
    exit;
}

$idVino = (int)$data['idVino'];
$idBodega = (int)$data['idBodega'];

$vino = new Vino(
    $idVino,
    $data['nombre'] ?? null,
    $data['descripcion'] ?? null,
    isset($data['anio']) && $data['anio'] !== '' ? (int)$data['anio'] : null,
    isset($data['alcohol']) && $data['alcohol'] !== '' ? (float)$data['alcohol'] : null,
    $data['tipo'] ?? null,
    null
);

VinoDB::update($idVino, $vino, $idBodega);

echo json_encode(['success' => true]);
