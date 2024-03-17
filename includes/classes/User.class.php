<?php
include_once('./system/config.php');
include_once('DatabaseManager.class.php');
include_once('./includes/classes/Post.class.php');

class User {

    //properties
    public int $id;
    public string $username;
    public string $forname;
    public string $lastname;
    public string $email;
    private string $password;
    public $created;

    //getters/setters
    public function getId(): int {
        return $this->id;
    }
    
    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $value): void {
        if (strlen($value) < 4) {
            throw new Exception('Användarnamn måste vara minst 4 tecken långt.');
        }
        if (strlen($value) > 50) {
            throw new Exception('Användarnamn får inte vara över 50 tecken långt.');
        }
        $this->username = $value;
    }

    public function getForname(): string {
        return $this->forname;
    }

    public function setForname(string $value): void {
        if (strlen($value) < 1) {
            throw new Exception('Förnamn får inte vara tomt.');
        }
        if (strlen($value) > 50) {
            throw new Exception('Förnamn får inte vara över 50 tecken långt.');
        }
        $this->forname = $value;
    }

    public function getLastname(): string {
        return $this->lastname;
    }

    public function setLastname(string $value): void {
        if (strlen($value) < 1) {
            throw new Exception('Efternamn får inte vara tomt.');
        }
        if (strlen($value) > 50) {
            throw new Exception('Efternamn får inte vara över 50 tecken långt.');
        }
        $this->lastname = $value;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $value): void {
        if (strlen($value) < 1) {
            throw new Exception('Epost får inte vara tomt.');
        }
        if (strlen($value) > 50) {
            throw new Exception('Epost får inte vara över 50 tecken långt.');
        }
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Epost är inte korrekt formaterat.');
        }
        $this->email = $value;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $value): void {
        $this->password = $value;
    }

    public function getCreated(): string {
        return $this->username;
    }


    //konstruktor
    public function __construct(array $array){
        if (array_key_exists('id', $array)) {
            $this->id = $array['id'];
        }
        $this->setUsername($array['username']);
        $this->setPassword($array['password']);
        $this->setForname($array['forname']);
        $this->setLastname($array['lastname']);
        $this->setEmail($array['email']);
        if (array_key_exists('created', $array)) {
            $this->created = $array['created'];
        }
    }

    //hämtar en user baserat på id
    public static function getUnique(int $id): User {
        $dbm = DatabaseManager::getInstance();
        $stmt = $dbm->mysqli->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $dbresult = $stmt->get_result();
        $result = $dbresult->fetch_all(MYSQLI_ASSOC);

        if (count($result) != 1) {
            throw new Exception('Finns ingen användare med id ' . $id);
        }

        return new User($result[0]);
    }

    //hämtar en user baserat på username
    public static function getByUsername(string $username): User {
        $dbm = DatabaseManager::getInstance();
        $stmt = $dbm->mysqli->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $dbresult = $stmt->get_result();
        $result = $dbresult->fetch_all(MYSQLI_ASSOC);

        if (count($result) != 1) {
            throw new Exception('Finns ingen användare med användarnamn ' . $username);
        }

        return new User($result[0]);
    }

    //returnerar true om $username finns som användarnamn i databasen
    public static function usernameExists(string $username): bool {
        $dbm = DatabaseManager::getInstance();
        $stmt = $dbm->mysqli->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        return ($stmt->num_rows > 0);
    }

    //kontrollerar om $username finns i databasen och om $password är korrekt, svarar med ett User objekt om korrekt annars kastar exception
    public static function tryLogin(string $username, string $password): User {
        $u = User::getByUsername($username);

        if (password_verify($password, $u->password)) {
            $_SESSION['username'] = $username;
            $_SESSION['userid'] = $u->id;
            return $u;
        }

        throw new Exception('Fel användarnamn och/eller lösenord.');
    }

    //skapar en ny användare i databasen
    public static function newUser(array $array): User {
        if (!array_key_exists('password', $array)) {
            throw new Exception('Lösenordsfält saknas.');
        }

        User::validatePasswordComplexity($array['password']);
        $array['password'] = password_hash($array['password'], PASSWORD_DEFAULT);

        if (User::usernameExists($array['username'])) {
            throw new Exception('Användarnamn är redan taget.');
        }

        $user = new User($array);

        $dbm = DatabaseManager::getInstance();
        $stmt = $dbm->mysqli->prepare('INSERT INTO user (forname, lastname, email, username, password) VALUES (?, ?, ?, ?, ?);');
        $stmt->bind_param('sssss', $user->forname, $user->lastname, $user->email, $user->username, $user->password);
        $stmt->execute();

        $user->id = $stmt->insert_id;

        return $user;
    }

    //kontrollerar om ett angivet lösenord motsvarar krav på lösenordskomplexitet, kastar exception om något inte är korrekt
    private static function validatePasswordComplexity(string $password): void {
        $hasUppercase = preg_match('@[A-Z]@', $password);
        $hasLowercase = preg_match('@[a-z]@', $password);
        $hasNumber = preg_match('@[0-9]@', $password);
        $hasSpecialChars = preg_match('@[^\w]@', $password);

        if(!$hasUppercase) {
            throw new Exception('Lösenord måste innehålla minst en versal.');
        }

        if(!$hasLowercase) {
            throw new Exception('Lösenord måste innehålla minst en gemen.');
        }

        if(!$hasNumber) {
            throw new Exception('Lösenord måste innehålla minst en siffra.');
        }

        if(!$hasSpecialChars) {
            throw new Exception('Lösenord måste innehålla minst ett specialtecken.');
        }

        if(strlen($password) < 6) {
            throw new Exception('Lösenord måste vafra minst 6 tecken långt.');
        }
    }

    //hämtar en array med alla användare
    public static function allUsers(): array {
        $dbm = DatabaseManager::getInstance();
        $stmt = $dbm->mysqli->prepare("SELECT * FROM user ORDER BY username DESC");
        $stmt->execute();
        $dbresult = $stmt->get_result();
        $result_array = $dbresult->fetch_all(MYSQLI_ASSOC);

        $result = [];
        foreach ($result_array as $row) {
            array_push($result, new User($row));
        }

        return $result;
    }

    //hämtar inloggad användare
    public static function getLoggedInUser(): User {
        if (!is_int($_SESSION['userid'])) {
            throw new Exception('Kan inte avgöra inloggad användare.');
        }
        return User::getUnique($_SESSION['userid']);
    }

    //hämtar alla användarens posts
    public function getPosts(int $page = 1, int $pagesize = 50): array {
        return Post::postsByUserId($this->id, $page, $pagesize);
    }

    public static function logout(): void {
        session_start();
        session_destroy();
    }


}
?>