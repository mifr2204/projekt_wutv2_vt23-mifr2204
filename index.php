<?php
include_once('system/common.php');
include('includes/header.php');
include('includes/sidemenu.php');
include_once('includes/classes/Posts.class.php');

$posts = new Posts();
$post = $posts->latestPost();
//$userid = $post['username'];


foreach($post as $item) {
    ?>
    <article>
    <h3><?= $item['title']; ?></h3>
    <p>________________________ </p>
    <p>Skapad <?= $item['created']; ?> </p>
    <div class="by">
    <p>Av</p>
    <p class="username"> <?= $item['username'];?></p>
    <p class="underscore">________________________ </p>
    <h4><?= $item['content']; ?></h4>
   
    <a href="./posts.php?id=<?= $item['id']; ?>">Läs mer</a>
    
    </article>
    
    <?php
}

$users = new User();
$user = $users->allUsers();
?>
<div class="userlist">
    <ul>
<?php
foreach($user as $item) {
    ?>
    <li> <a href="./userpost.php?id=<?= $item['id']; ?>"><?= $item['username']; ?></a></li>
   
    
    <?php
}
?>

    </ul>
</div>
<?php
//navcont och last ska vara lika typ


include('includes/footer.php');
?>