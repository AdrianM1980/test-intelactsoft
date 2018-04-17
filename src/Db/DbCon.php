<?php
namespace Mtest\Db;
//D:\projects\mtest\src\config\db.php
require_once './src/config/db.php';

class DbCon{

    private static $db = null;
    private function __constructor(){}
    
    static function con(){
       
//$dsn = "mysql:dbname=".self::DB_DATABASE.";host=".self::DB_HOST;
        if(empty(self::$db)){
              $dsn = "mysql:dbname=".DB_NAME.";host=".DB_HOST;
              self::$db = new \PDO($dsn, DB_USER, DB_PASSWORD);
        }
        return self::$db;
    }
}