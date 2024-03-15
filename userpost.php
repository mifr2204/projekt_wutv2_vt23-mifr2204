<?php
include_once('system/common.php');
include('includes/header.php');
include('includes/sidemenu.php');
include_once('includes/classes/Posts.class.php');

$userid = $_SESSION;


$posts = new Posts();
$post = $posts->userPost($userid);



foreach($post as $item) {
    ?>
    <article>
    <h3><?= $item['title']; ?></h3>
    <p>________________________ </p>
    <p>Skapad <?= $item['created']; ?> </p>
    <div class="by">
    <p>Av</p>
    <p class="username"> <?= $item['username'] ?></p>
    <p class="underscore">________________________ </p>
    <h4><?= $item['content']; ?></h4>
   
    <a class="readbtn" href="./posts.php?id=<?= $item['id']; ?>">Läs mer</a>
    <a class="changebtn" href="./changePost.php?id=<?= $item['id']; ?>">Ändra</a>
   
    </article>
    
    <?php
}

//navcont och last ska vara lika typ


include('includes/footer.php');
?>