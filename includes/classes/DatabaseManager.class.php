<?php
include_once('./system/config.php');

//databas hanteras via singleton designmönster för att undvika att flera instanser skapas samtidigt mot samma databas
/*
    exempel
    $dbm = DatabaseManager::getInstance();
    $dbm->mysqli->query("SELECT * FROM users");


    en singleton är en klass som alltid bara har en instans, genom att alltid använda metoden "getInstance" istället för "new DatabaseManager()",
    på så vis används alltid samma uppkopplings mot databasen oavsett hur många instanser av DatabaseManager som används.
*/
class DatabaseManager
{

    public $mysqli;
    private static $instances = [];

    //konstruktor -- skapar en instans av databaskoppling
    protected function __construct() {
        $this->mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE, DBPORT);
        if($this->mysqli->connect_errno > 0) {
            die('Anslutning kan inte skapas' . $this->mysqli->connect_error);
        };
    }

    //hämtar singleton instans
    public static function getInstance(): DatabaseManager
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

}
?>