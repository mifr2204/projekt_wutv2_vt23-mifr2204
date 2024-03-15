<?php
include_once('./system/config.php');
include_once('./includes/classes/User.class.php');
class Posts {
    private $db;

    //constructior
    function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE, DBPORT);
        if($this->db->connect_errno > 0) {
            die("Något gick fel i anslutningen " . $this->db->connect_error);
        }
    }

    //lägga till sida
    public function newPost($title, $content) {
        $username = $_SESSION['username'];
        
        $sql = "SELECT * FROM user WHERE username='$username';";
        
        $result = $this->db->query($sql);
        
        $row = $result->fetch_assoc();

        $userid = $row['id'];

        $sql = "INSERT INTO posts(userid, title, content)VALUES('$userid','$title', '$content');";
        return $this->db->query($sql);
    }

    public function changePost($id, $title, $content) {
        
        $id = intval($id);

        $sql = "UPDATE posts SET title = '$title', content = '$content' WHERE id=$id";
        
        return $this->db->query($sql);
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


    //FIXME sql injections?
    //hämta sida
    public function getPost($id) {
        $id = intval($id);

        $sql = "SELECT * FROM posts WHERE id=$id";

        $result = $this->db->query($sql);
        
        $row = mysqli_fetch_array($result);

        return $row;
    }
    public function delPost($id) {
        $id = intval($id);

        $sql = "DELETE FROM posts WHERE id=$id";

        return $this->db->query($sql);
    }

    public function latestPost(){
        //$sql = "SELECT * FROM posts ORDER BY created DESC";
        $sql = "SELECT posts.*, user.username from posts inner join user on user.id = posts.userid";
        
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
       
    }

    
    public function userPost($id){
        $id = intval($id);
        $sql = "SELECT posts.*, user.username from posts inner join user on user.id = $id";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
/*
    public function userPost($id){
        $id = intval($id);
        $sql = "SELECT posts.*, user.username from posts inner join user on user.id = $id";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
  */  


}