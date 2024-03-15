<?php
/*mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (class_exists('database'))
{
    return database::get_instance();
}

class database
{
    private static $instance = null;
    protected $connection;
    
    //connects to database
    private function __construct()
    {
        $config = include('system/config.php');
        $this->connection = new mysqli($config['database']['url'], $config['database']['username'], $config['database']['password'], $config['database']['database'], $config['database']['port']);
        $this->connection->set_charset("utf8");
    }
    //checks for connection to database, if there is none, runs _construct, if there is one runs the connection 
    public static function get_instance()
    {
        if (self::$instance == null)
        {
            self::$instance = new database();
        }
        return self::$instance;
    }
    //runs queries towards the database, returns the result from the query    
    public function query($querystring) {
        $result = $this->connection->query($querystring);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    //on delete or update- returns the numer of affected rows to avoid error

    public function execute($querystring) {
        $result = $this->connection->prepare($querystring);
        $result->execute();
        return $result->num_rows;
    }
    //protects against changes in the database made by users
    public function escape($value) {
        return $this->connection->real_escape_string($value);
    }

}

return database::get_instance();
*/
?>
