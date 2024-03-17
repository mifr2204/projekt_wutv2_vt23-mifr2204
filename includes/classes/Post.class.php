<?php
include_once('./system/config.php');
include_once('DatabaseManager.class.php');
include_once('./includes/classes/User.class.php');

class Post {
    
    //properties
    public int $id;
    public int $userId;
    public string $title;
    public string $content;
    public $created;

    //getters/setters
    public function getId(): int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function setUserId(int $value): void {
        $this->userId = $value;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $value): void {
        if (strlen($value) < 3) {
            throw new Exception('Titel måste vara minst 3 tecken långt.');
        }
        if (strlen($value) > 50) {
            throw new Exception('Titel får inte vara över 50 tecken långt.');
        }
        $this->title = $value;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $value): void {
        if (strlen($value) < 1) {
            throw new Exception('Innehåll får inte vara tomt.');
        }
        if (strlen($value) > 5000) {
            throw new Exception('Innehåll får inte vara över 5000 tecken långt.');
        }
        $this->content = $value;
    }

    public function getCreated() {
        return $this->created;
    }

    //konstruktor
    public function __construct(array $array){
        if (array_key_exists('id', $array)) {
            $this->id = $array['id'];
        }
        if (array_key_exists('userId', $array)) {
            $this->setUserId($array['userId']);
        }
        if (array_key_exists('userid', $array)) {
            $this->setUserId($array['userid']);
        }
        $this->setTitle($array['title']);
        $this->setContent($array['content']);
        if (array_key_exists('created', $array)) {
            $this->created = $array['created'];
        }
    }

    
    //hämtar en post baserat på id
    public static function getUnique(int $id): Post {
        $dbm = DatabaseManager::getInstance();
        $stmt = $dbm->mysqli->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $dbresult = $stmt->get_result();
        $result = $dbresult->fetch_all(MYSQLI_ASSOC);

        if (count($result) != 1) {
            throw new Exception('Finns ingen post med id ' . $id);
        }

        return new Post($result[0]);
    }


    //skapar en ny post i databasen
    public static function newPost(array $array): Post {

        if (!array_key_exists('userId', $array)) {
            $user = User::getLoggedInUser();
            $array['userId'] = $user->id;
        }

        $post = new Post($array);

        $dbm = DatabaseManager::getInstance();
        $stmt = $dbm->mysqli->prepare('INSERT INTO posts (userid, title, content) VALUES (?, ?, ?);');
        $stmt->bind_param('iss', $post->userId, $post->title, $post->content);
        $stmt->execute();

        $post->id = $stmt->insert_id;

        return $post;
    }

    //sparar ändringar i post till databasen
    public function update(): void {
        $dbm = DatabaseManager::getInstance();
        $stmt = $dbm->mysqli->prepare('UPDATE posts SET userid=?, title=?, content=? WHERE id=?);');
        $stmt->bind_param('issi', $post->userId, $post->title, $post->content, $post->id);
        $stmt->execute();
    }

    //raderar post från databasen
    public function delete(): void {
        $dbm = DatabaseManager::getInstance();
        $stmt = $dbm->mysqli->prepare('DELETE FROM posts WHERE id=?;');
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
    }

    //hämtar en User instans baserat på postens userId
    public function getUser(): User {
        return User::getUnique($this->userId);
    }
    
    //hämtar en array med alla posts
    public static function allPosts(): array {
        $dbm = DatabaseManager::getInstance();
        $stmt = $dbm->mysqli->prepare("SELECT * FROM posts ORDER BY created DESC");
        $stmt->execute();
        $dbresult = $stmt->get_result();
        $result_array = $dbresult->fetch_all(MYSQLI_ASSOC);

        $result = [];
        foreach ($result_array as $row) {
            array_push($result, new Post($row));
        }

        return $result;
    }
    
    //hämtar en array med N antal posts, sorterat på created
    public static function allPostsWithLimit(int $limit): array {
        $dbm = DatabaseManager::getInstance();
        $stmt = $dbm->mysqli->prepare("SELECT * FROM posts ORDER BY created DESC LIMIT ?");
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        $dbresult = $stmt->get_result();
        $result_array = $dbresult->fetch_all(MYSQLI_ASSOC);

        $result = [];
        foreach ($result_array as $row) {
            array_push($result, new Post($row));
        }

        return $result;
    }

    //hämtar alla posts baserat på userid
    public static function postsByUserId(int $userId, int $page = 1, int $pagesize = 50): array {
        $limit = $pagesize;
        $offset = ($page-1) * $pagesize;
        $dbm = DatabaseManager::getInstance();
        $stmt = $dbm->mysqli->prepare("SELECT * FROM posts WHERE userid=? ORDER BY created DESC LIMIT ? OFFSET ?");
        $stmt->bind_param('iii', $userId, $limit, $offset);
        $stmt->execute();
        $dbresult = $stmt->get_result();
        $result_array = $dbresult->fetch_all(MYSQLI_ASSOC);

        $result = [];
        foreach ($result_array as $row) {
            array_push($result, new Post($row));
        }

        return $result;
    }

    public static function postPagesByUserId(int $userId, int $pagesize = 50): int {
        $numberOfRows = Post::countPostsByUserId($userId);
        $result = ceil($numberOfRows / $pagesize);
        return $result;
    }

    public static function countPostsByUserId(int $userId): int {
        $dbm = DatabaseManager::getInstance();
        $stmt = $dbm->mysqli->prepare("SELECT COUNT(*) FROM posts WHERE userid=?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $stmt->bind_result($numberOfRows);
        $stmt->fetch();
        return $numberOfRows;
    }

}