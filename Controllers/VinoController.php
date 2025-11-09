<?php
namespace Controllers;

use Exception;
use Models\DB\VinoDB;

require_once __DIR__ . "/BaseController.php";
require_once __DIR__ . "/../Models/DB/VinoDB.php";

class VinoController extends BaseController {

	// Muestra la vista para añadir un nuevo vino.
	// NOTA: No se implementa la lógica de creación (create), el usuario la implementará desde 0.
	public function addVino() {
        $idBodega = $_GET['idBodega'] ?? null;
        if(!$idBodega) throw new Exception("No hay un id de bodega al que añadir un vino");
		$this->render('vino/vino.create', ['idBodega' => $idBodega]);
	}
    
    public function edit(){
        $idVino = $_GET['id'] ?? null;
        if(!$idVino) throw new Exception("No hay un id de vino");
        $vino = VinoDB::getById($idVino);
        if(!$vino) throw new Exception("No se ha encontrado ningún vino");
        $this->render('vino/vino.edit', ['vino' => $vino]);
    }

}

?>