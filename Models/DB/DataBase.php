<?php 
namespace Models\DB;
require_once __DIR__ . "/config.php";
use PDO;
use PDOException;

class DataBase{
    
    private static ?PDO $dbh = null;

    public static function getConnection(){
        if(self::$dbh == null){
            try{
                $dsn="mysql:host=" . HOST . ";dbname=" . DB_NAME . ";charset;utf8mb4";
                self::$dbh = new PDO($dsn, USER, "");
                self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(\PDOException $pdo){
                echo "<strong>Error de conexión:</strong> " . $pdo->getMessage();
                return null;
            }
        }
        return self::$dbh;        
    }
}



?>