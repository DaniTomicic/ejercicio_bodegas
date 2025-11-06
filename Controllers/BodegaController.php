<?php 
namespace Controllers;

use Exception;
use Controllers\BaseController;
use DateTime;
use Models\Bodega;
use Models\DB\BodegaDB;
require_once __DIR__ . "/BaseController.php";
require_once __DIR__ . "/../Models/DB/BodegaDB.php";

class BodegaController extends BaseController{
    
    public function index() {        
        $bodegas = BodegaDB::getAll();
        $this->render('index', ['bodegas' => $bodegas]);
    }

    public function verBodega(){
        $idBodega = $_GET['id'] ?? null;
        
        if(!$idBodega){
            throw new Exception("No hay id para ver la bodega");
        }

        $bodega = BodegaDB::getById($idBodega);
        if(!$bodega) throw new Exception("No se ha encontrado ninguna bodega");

        $this->render('bodega/bodega', ['bodega' => $bodega]);
    }
    public function createView(){
        $this->render('bodega/bodega.create', []);
    }
    public function create() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $bodega = new Bodega(
                null,
                nombre: $_POST['nombre'],
                localizacion: $_POST['localizacion'],
                telefono: $_POST['telefono'] ?? null,
                email: $_POST['email'] ?? null,
                contacto: $_POST['contacto']??null,
                descripcion: $_POST['descripcion'],
                tieneRestaurante: $_POST['tiene_restaurante'] ?? false,
                tieneHotel: $_POST['tiene_hotel'] ?? false,
                fechaFundacion: new DateTime($_POST['fecha_fundacion']),
                vinos: [],
            );
            
            BodegaDB::create($bodega);
        }
        header('Location: index.php?controller=BodegaController&action=index');
        exit;

    }

    public function edit(){
        $idBodega = $_GET['id'] ?? null;
        if(!$idBodega){
            throw new Exception("No hay id para ver la bodega");
        }

        $bodega = BodegaDB::getById($idBodega);
        if(!$bodega) throw new Exception("No se ha encontrado ninguna bodega");

        $this->render('bodega/bodega.edit', ['bodega' => $bodega]);
    }
    public function update(){      
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $bodega = new Bodega(
                id_bodega: (int)$id,
                nombre: $_POST['nombre'],
                localizacion: $_POST['localizacion'],
                telefono: $_POST['telefono'] ?? null,
                email: $_POST['email'] ?? null,
                contacto: $_POST['contacto'] ?? null,
                descripcion: null,
                tieneRestaurante: $_POST['tiene_restaurante'] === 'true',
                tieneHotel: $_POST['tieneHotel'] === 'true',
                fechaFundacion: new DateTime($_POST['fecha_fundacion']),
                vinos: []
            );

            BodegaDB::update($id, $bodega);
            
            header("Location: index.php?controller=BodegaController&action=verBodega&id=$id");
            exit;
        }
    }
    public function delete()  {
        $id = $_GET['id'] ?? null;
        
        if($id){
            BodegaDB::delete($id);
        }
        
        
        header("Location: index.php?controller=BodegaController&action=index");
        exit;
    }

}


?>