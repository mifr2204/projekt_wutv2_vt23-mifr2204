<?php

include_once('./system/config.php');

class User {

    private $db;

    public function __construct(){
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE, DBPORT);
        if($this->db->connect_errno > 0) {
            die('Anslutning kan inte skapas' . $this->db->connect_error);
        };
    }

    public function login(string $username, string $password) : bool {
        $sql = "SELECT * FROM user WHERE username ='$username';"; //ska vara en set metod för att kolla 
        $result = $this->db->query($sql);
    
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $storedP = $row['password'];

            if(password_verify($password, $storedP)) {
                $_SESSION['username'] = $username;
                return true;
            } else {
                return false;
            }

        }else {
            return false;
        }
    }

    public function allUsers(){
        $sql = "SELECT * FROM user ORDER BY username DESC";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function getUser($id){
        $sql = "SELECT * FROM user WHERE id = '$id'";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

   /* if(isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if(login($username, $password) === true) {
            $_SESSION['username'] = $username;
            header("location: ./blogg.php");
            echo "<p class='message'>Du är inloggad</p>";
        } else{
            "<p class='error'>Du kunde inte loggas in</p>";
        } //FIXME som d andra?
    }
    */
//registrera

    public function newUser(string $forname, string $lastname, string $email, string $username, string $password) : bool {
        $hashedP = password_hash($password, PASSWORD_DEFAULT);
        
        //Fix me gör set-get metoder för att kolla alla inputs 
        
        $sql = "INSERT INTO user(forname, lastname, email, username, password)VALUES('$forname', '$lastname', '$email', '$username', '$hashedP');";
        $result = $this->db->query($sql);
        
        return $result;
    }
    //c

    /*
    public $id;
    public $username;

    public function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
        return $this;
    }
    //controlls user data againgst databaase
    public static function get_by_username_and_password($username, $password) {
        $db = include('includes/classes/Database.class.php');
        $result = $db->query('SELECT * FROM user WHERE username = "' . $db->escape($username) . '"');
        if ($result) {
            if (md5($password) == $result[0]['password'])
            {
                return new user($result[0]['id'], $result[0]['username']);
            }
        }
    }
    //controlls user data againgst database when loged in 
    public static function get_by_id($id) {
        $db = include('includes/classes/Database.class.php');
        $result = $db->query('SELECT * FROM user WHERE id = ' . intval($id));
        if ($result) {
                return new user($result[0]['id'], $result[0]['username']);
        }
        return false;
    }
*/
}

?>