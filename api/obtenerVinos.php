<?php
// Devuelve todos los vinos como JSON (sin cláusula WHERE)
header('Content-Type: application/json');

require_once __DIR__ . '/../Models/DB/DataBase.php';

use Models\DB\DataBase;

$pdo = DataBase::getConnection();
if (!$pdo) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'No se pudo conectar a la base de datos']);
    exit;
}

try {
    $sql = $pdo->prepare("SELECT v.id_vino, v.nombre AS nombre, v.descripcion, v.anio, v.alcohol, v.tipo, v.id_bodega,
                                 b.nombre AS bodega_nombre, b.localizacion AS bodega_localizacion, b.telefono AS bodega_telefono,
                                 b.email AS bodega_email
                          FROM vinos v
                          LEFT JOIN bodegas b ON v.id_bodega = b.id_bodega");
    $sql->execute();
    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'data' => $rows]);
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

?>