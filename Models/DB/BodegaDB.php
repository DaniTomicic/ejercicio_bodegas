<?php
namespace Models\DB;

use Models\Bodega;
use Models\Vino;
use Models\DB\DataBase;
use DateTime;
use PDO;
use PDOException;
use ReturnTypeWillChange;

require_once __DIR__ . "/DataBase.php";
require_once __DIR__ . "/../Bodega.php";
require_once __DIR__ . "/../Vino.php";

class BodegaDB{    
    public static function create(Bodega $bodega){
        try{
            $pdo = DataBase::getConnection();
            $sql = $pdo->prepare("INSERT INTO 
                                    bodegas(nombre, localizacion, telefono, email, contacto, descripcion, tiene_restaurante, tiene_hotel, fecha_fundacion) 
                                    VALUES(:nombre, :localizacion, :telefono, :email, :contacto, :descripcion, :tiene_restaurante, :tiene_hotel, :fecha_fundacion); 
                                ");
            $sql->bindValue(":nombre", $bodega->getNombre());
            $sql->bindValue(":localizacion", $bodega->getLocalizacion());
            $sql->bindValue(":telefono", $bodega->getTelefono());
            $sql->bindValue(":email", $bodega->getEmail());
            $sql->bindValue(":contacto", $bodega->getContacto());
            $sql->bindValue(":descripcion", $bodega->getDescripcion());
            $sql->bindValue(":tiene_restaurante", $bodega->tieneRestaurante());
            $sql->bindValue(":tiene_hotel", $bodega->tieneHotel());
            $sql->bindValue(":fecha_fundacion",$bodega->getFechaFundacion()->format('Y-m-d'));

            $sql->execute();

        }catch(PDOException $pdoe){
            $pdoe->getMessage();
        }
        return null;

    }
    public static function getAll() :array|null {
        try{
            $pdo = DataBase::getConnection();
            
            $sql = $pdo->prepare("SELECT id_bodega, nombre, localizacion, telefono, email, contacto, descripcion, tiene_restaurante, tiene_hotel, fecha_fundacion FROM bodegas");

            $sql->execute();
        }catch(PDOException $pdoe){
            echo $pdoe->getMessage();
        }
        return $sql->fetchAll(PDO::FETCH_ASSOC) ?? null;
    }

    public static function getById($idBodega) :Bodega|null {
        try{
            $pdo = DataBase::getConnection();
            
            $sql = $pdo->prepare("
                SELECT 
                    b.id_bodega AS b_id,
                    b.nombre AS b_nombre,
                    b.localizacion,
                    b.telefono,
                    b.email,
                    b.contacto,
                    b.descripcion AS b_descripcion,
                    b.tiene_restaurante,
                    b.tiene_hotel,
                    b.fecha_fundacion,

                    v.id_vino,
                    v.nombre AS v_nombre,
                    v.descripcion AS v_descripcion,
                    v.anio,
                    v.alcohol,
                    v.tipo

                FROM bodegas b 
                LEFT JOIN vinos v ON b.id_bodega = v.id_bodega
                WHERE b.id_bodega = :id");
            $sql->bindValue(":id", $idBodega);
            $sql->execute();

            // Al ser una join nos devuelve 0:n filas (cursor) por lo que hay que recorrer las rows para ver si ha devuelto algo
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            if(!$rows) return null;
            //en caso de haber rows llama a un Mapper para luego devolver todo el obj. Bodega + vinos[]
            return self::mapBodega($rows);
        }catch(PDOException $pdoe){
            echo $pdoe->getMessage();
        }
        return $bodega ?? null;
    }

    public static function update(int $id, Bodega $bodega){
        $pdo = DataBase::getConnection();
        try{
            $sql = $pdo->prepare("
                        UPDATE bodegas SET
                            nombre = :nombre,
                            localizacion = :localizacion,
                            telefono = :telefono,
                            email = :email,
                            contacto = :contacto,
                            tiene_restaurante = :tieneRestaurante,
                            tiene_hotel = :tieneHotel
                        WHERE id_bodega = :id;
            ");

            $sql->bindValue(":nombre", $bodega->getNombre());
            $sql->bindValue(":localizacion", $bodega->getLocalizacion());
            $sql->bindValue(":telefono", $bodega->getTelefono());
            $sql->bindValue(":email", $bodega->getEmail());
            $sql->bindValue(":contacto", $bodega->getContacto());
            $sql->bindValue(":tieneRestaurante", $bodega->tieneRestaurante() ? 1 : 0, PDO::PARAM_INT);
            $sql->bindValue(":tieneHotel", $bodega->tieneHotel() ? 1 : 0, PDO::PARAM_INT);
            $sql->bindValue(":id", $id);
            
            $sql->execute();            
        }catch(PDOException $pdoe){
            echo $pdoe->getMessage();
        }
        return null;
    }

    public static function delete(int $id){
        $pdo = DataBase::getConnection();
        try{
            $sql = $pdo->prepare("DELETE FROM bodegas WHERE id_bodega = :id;");
            
            $sql->bindValue(":id", $id);
            
            $sql->execute();            
        }catch(PDOException $pdoe){
            echo $pdoe->getMessage();
        }
        return null;
    }



    private static function mapBodega($rows){
        $first = $rows[0];
        
        $bodega = new Bodega(
                id_bodega: $first['b_id'],
                nombre: $first['b_nombre'],
                localizacion: $first['localizacion'],
                telefono: $first['telefono'] ?? null,
                email: $first['email'] ?? null,
                contacto: $first['contacto'] ?? null,
                descripcion: $first['b_descripcion'] ?? null,
                tieneRestaurante: $first['tiene_restaurante'] ?? false,
                tieneHotel: $first['tiene_hotel'] ?? false,
                fechaFundacion: new DateTime($first['fecha_fundacion']) ?? new DateTime(),
                vinos: [],
            );
            $vinos = []; 
            foreach($rows as $row){
                $vinos[] = new Vino(
                    (int)$row['id_vino'],
                    $row['v_nombre'],
                    $row['v_descripcion'] ?? null,
                    $row['anio'] ?? null,
                    $row['alcohol'] ?? null,
                    $row['tipo'] ?? null,
                    null,
                );
            }

            $bodega->setVinos($vinos);
        return $bodega;
    }
}
    


?>