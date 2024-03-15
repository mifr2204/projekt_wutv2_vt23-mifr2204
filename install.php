<?php
include("system/config.php");

$message = false;

//Databasanslutning
$db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE, DBPORT);
if($db->connect_errno > 0){
    die("Kan inten ansluta [" . $db->connect_error . "]");
}

try {
    $stmt = $db->prepare("DROP TABLE IF EXISTS user, posts;");
    $stmt->execute();

    $stmt = $db->prepare("CREATE TABLE user(
        id INT(20) PRIMARY KEY AUTO_INCREMENT,
        forname VARCHAR(20) NOT NULL,
        lastname VARCHAR(64) NOT NULL,
        email VARCHAR(64) NOT NULL,
        username VARCHAR(64) NOT NULL,
        password VARCHAR(256) NOT NULL,
        created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    );");
    $stmt->execute();


    $stmt = $db->prepare("CREATE TABLE posts(
        id INT(11) PRIMARY KEY AUTO_INCREMENT,
        userid INT(20) NOT NULL, 
        title VARCHAR(32) NOT NULL,
        content TEXT,
        created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    );");
    $stmt->execute();

    $stmt = $db->prepare("ALTER TABLE posts
        ADD FOREIGN KEY (userid) REFERENCES user(id)
        ");
    $stmt->execute();
    
} catch (Exception $e) {
    $message = true;
}


if ($message)
{
    echo "Ett fel inträffade";
} else {
    echo "Databas installerad";
}
