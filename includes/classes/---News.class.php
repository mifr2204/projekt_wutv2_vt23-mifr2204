<?php
class news {
    
    public $id;
    public $content;
    public $post_date;
    public $title;
    public $created_by;
    //creates a news
    public function __construct($id, $content, $post_date, $title, $created_by)
    {
        $this->id = $id;
        $this->content = $content;
        $this->post_date = $post_date;
        $this->title = $title;
        $this->created_by = $created_by;
        return $this;
    }
    //gets news sorted by post date
    public static function get_latest($n = false) {
        $db = include('includes/classes/Database.class.php');
        if ($n) {
            $n = ' LIMIT ' . intval($n);
        }
        $q = $db->query('SELECT * FROM news ORDER BY post_date DESC' . $n);
        $result = array();
        foreach ($q as $row) {
            array_push($result, new news($row['id'], $row['content'], $row['post_date'], $row['title'], $row['created_by']));
        }
        return $result;
    }
    //gets a specific news 
    public static function get_by_id($id) {
        $db = include('includes/classes/Database.class.php');
        $q = $db->query('SELECT * FROM news WHERE id = ' . intval($id));
        if (!$q)
        {
            return false;
        }
        return new news($q[0]['id'], $q[0]['content'], $q[0]['post_date'], $q[0]['title'], $q[0]['created_by']);
    }
    //delete  a news
    public function delete() {
        $db = include('includes/classes/Database.class.php');
        $db->execute('DELETE FROM news WHERE id = ' . intval($this->id));
    }
    //puts a user to the news as author
    public function author() {
        include_once('includes/classes/User.class.php');
        return user::get_by_id(intval($this->created_by));
    }
    //creates a news
    public static function create($title, $content, $created_by) {
        $db = include('includes/classes/Database.class.php');
        $db->execute('INSERT INTO news (title, content, created_by, post_date) VALUES ("' . $db->escape($title) . '", "' . $db->escape($content) . '", ' . intval($created_by) . ', ' . time() . ')');
    }

}
?>