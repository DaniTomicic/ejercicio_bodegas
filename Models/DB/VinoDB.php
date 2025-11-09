<?php
namespace Models\DB;

use Models\Vino;
use Models\Bodega;
use Models\DB\DataBase;
use PDO;

require_once __DIR__ . '/../Vino.php';
require_once __DIR__ . '/DataBase.php';
require_once __DIR__ . '/../Bodega.php';

class VinoDB {
    public static function create(Vino $vino, int $id_bodega) {
        $pdo = DataBase::getConnection();
        $sql = $pdo->prepare("INSERT INTO vinos (nombre, descripcion, anio, alcohol, tipo, id_bodega) VALUES (:nombre, :descripcion, :anio, :alcohol, :tipo, :id_bodega)");
        $sql->bindValue(":nombre", $vino->getNombre());
        $sql->bindValue(":descripcion", $vino->getDescripcion());
        $sql->bindValue(":anio", $vino->getAnio());
        $sql->bindValue(":alcohol", $vino->getAlcohol());
        $sql->bindValue(":tipo", $vino->getTipo());
        $sql->bindValue(":id_bodega", $id_bodega);
        $sql->execute();
        return $pdo->lastInsertId();
    }

    public static function update(int $idVino, Vino $vino, int $idBodega){
        try{
            $pdo = DataBase::getConnection();
            $sql = $pdo->prepare("UPDATE vinos SET nombre = :nombre, descripcion = :descripcion, anio = :anio, alcohol = :alcohol, tipo = :tipo WHERE id_vino = :id_vino AND id_bodega = :id_bodega;");

            $sql->bindValue(":nombre", $vino->getNombre());
            $sql->bindValue(":descripcion", $vino->getDescripcion());
            $sql->bindValue(":anio", $vino->getAnio());
            $sql->bindValue(":alcohol", $vino->getAlcohol());
            $sql->bindValue(":tipo", $vino->getTipo());
            $sql->bindValue(":id_vino", $idVino, PDO::PARAM_INT);
            $sql->bindValue(":id_bodega", $idBodega, PDO::PARAM_INT);

            $sql->execute();
        }catch(\PDOException $pdoe){
            echo $pdoe->getMessage();
        }
        return null;
    }
    public static function getById(int $id): Vino|null {
        try{
            $pdo = DataBase::getConnection();
            // Hacemos join con la bodega para devolver el objeto Bodega dentro del Vino
            $sql = $pdo->prepare("SELECT v.id_vino, v.nombre AS v_nombre, v.descripcion AS v_descripcion, v.anio, v.alcohol, v.tipo,
                                        b.id_bodega AS b_id, b.nombre AS b_nombre, b.localizacion AS b_localizacion, b.telefono AS b_telefono,
                                        b.email AS b_email, b.contacto AS b_contacto, b.descripcion AS b_descripcion, b.tiene_restaurante AS b_tiene_restaurante,
                                        b.tiene_hotel AS b_tiene_hotel, b.fecha_fundacion AS b_fecha_fundacion
                                 FROM vinos v
                                 LEFT JOIN bodegas b ON v.id_bodega = b.id_bodega
                                 WHERE v.id_vino = :id LIMIT 1");
            $sql->bindValue(":id", $id, PDO::PARAM_INT);
            $sql->execute();

            $row = $sql->fetch(PDO::FETCH_ASSOC);
            if(!$row) return null;

            // Crear objeto Bodega (si existe)
            $bodega = null;
            if(isset($row['b_id']) && $row['b_id'] !== null){
                $fecha = null;
                try{
                    $fecha = isset($row['b_fecha_fundacion']) && $row['b_fecha_fundacion'] ? new \DateTime($row['b_fecha_fundacion']) : new \DateTime();
                }catch(\Exception $ex){
                    $fecha = new \DateTime();
                }

                $bodega = new Bodega(
                    (int)$row['b_id'],
                    $row['b_nombre'] ?? '',
                    $row['b_localizacion'] ?? '',
                    $row['b_telefono'] ?? null,
                    $row['b_email'] ?? null,
                    $row['b_contacto'] ?? null,
                    $row['b_descripcion'] ?? null,
                    isset($row['b_tiene_restaurante']) ? (bool)$row['b_tiene_restaurante'] : false,
                    isset($row['b_tiene_hotel']) ? (bool)$row['b_tiene_hotel'] : false,
                    $fecha,
                    []
                );
            }

            return new Vino(
                isset($row['id_vino']) ? (int)$row['id_vino'] : null,
                $row['v_nombre'] ?? null,
                $row['v_descripcion'] ?? null,
                isset($row['anio']) && $row['anio'] !== null ? (int)$row['anio'] : null,
                isset($row['alcohol']) && $row['alcohol'] !== null ? (float)$row['alcohol'] : null,
                $row['tipo'] ?? null,
                $bodega
            );

        }catch(\PDOException $e){
            echo $e->getMessage();
        }
        return null;
    }

    public static function delete(int $idVino, int $idBodega){
        try{
            $pdo = DataBase::getConnection();
            $sql = $pdo->prepare("DELETE FROM vinos WHERE id_vino = :id_vino AND id_bodega = :id_bodega;");
            $sql->bindValue(":id_vino", $idVino, PDO::PARAM_INT);
            $sql->bindValue(":id_bodega", $idBodega, PDO::PARAM_INT);
            $sql->execute();
        }catch(\PDOException $pdoe){
            echo $pdoe->getMessage();
        }
        return null;
    }

}
