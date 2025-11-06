<?php 
namespace Controllers;

use Models\DB\BodegaDB;
require_once __DIR__ . "/../Models/DB/BodegaDB.php";

class BaseController{
    
    public function index() {
        $bodegas = BodegaDB::getAll(); 
        require __DIR__ .  "/../Views/index.php";
    }

    protected function render($viewPath, $data =[]){
        extract($data);
        require_once __DIR__ . "/../Views/" . $viewPath . '.php';
    }
}

?>