<?php
include_once('includes/classes/Post.class.php');
include_once('system/common.php');
include('includes/header.php');
include('includes/sidemenu.php');


if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("location: ./index.php");
}

$post = Post::getUnique($id);


?>
<h3><?= $post->title; ?><h3>
<?= $post->content; ?>

<div id="id">
<?= $id; ?>
</div>
<?php

include('includes/footer.php');




?>