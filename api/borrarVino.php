<?php 
// Recibe JSON por POST y guarda el vino en la BD
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

if (!isset($data['idBodega'], $data['idVino'])) {
	http_response_code(422);
	echo json_encode(['error' => 'No se encuentras el id de Bodega o el del Vino']);
	exit;
}

$id = VinoDB::delete((int)$data['idVino'], (int)$data['idBodega']);
echo json_encode(['success' => true, 'id_vino' => $id]);


?>