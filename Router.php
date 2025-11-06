<?php 
namespace Router;

use Exception;

class Router{
    public static function dispatch(){

        $controllerName = $_GET['controller'] ?? 'BaseController';
        
        $action = $_GET['action'] ?? 'index';

        try{
            self::loadController($controllerName, $action);
        }catch(Exception $e){
        }
    }
    private static function loadController($controllerName, $action){
        define('ACCESS_VIA_ROUTER', true);
        $controllerFile = "./Controllers/{$controllerName}.php";

        
        if(!file_exists($controllerFile)){
            return null;
        }

        $fqcnNamespaced = "\\Controllers\\{$controllerName}";
        require_once $controllerFile;

        if(class_exists($fqcnNamespaced)){
            $controller = new $fqcnNamespaced();
        }elseif(class_exists($controllerName)){
            $controller = new $controllerName();
        }else{
            return null;
        }

        if(!method_exists($controller, $action)){
            return null;
        }

        $controller->$action();

    }
}



?>