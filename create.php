<?php
include_once('includes/classes/User.class.php');
include_once('includes/classes/Post.class.php');
include_once('system/common.php');
include_once('system/config.php');
include('includes/header.php');
include('includes/sidemenu.php');
    
if(!isset($_SESSION['username'])) {
        header('location: login.php?message=Du måste vara inloggad');
 }  


//logout 

?>

<h2>Skapa Blogginlägg</h2>
<?php

if(isset($_POST['title'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $newPostArgs = array('title' => $_POST['title'], 'content' => $_POST['content']);

    try {
        $post = Post::newPost($newPostArgs);
        $message = "<div class='status'>✔️ Sidan är skapad</div>";
        ?>
        <a href="./create.php">Skapa Nytt inlägg</a>
        <?php
    } catch (Exception $e) {
        $message = '<div class="alert">' . $e->getMessage() . '</div>';
    }
}

if(isset($message)) {
    echo $message;
}

if(!isset($_POST['title'])) {
?>
<div id="createForm">
    <form action="./create.php" method="post">
        <div class="form-field">
            <label for="title">Titel</label>
            <input type="text" name="title" id="title" />
        </div>
        <div class="form-field">
            <label for="content">Innehåll</label>
            <textarea name="content" id="content" rows="15"></textarea>
        </div>

        <div class="form-field">
            <input id="createbtn" type="submit" value="Skapa" />
        </div>
    </form>
</div>
<?php
        }
?>
<script>
    CKEDITOR.replace( 'content' );
</script>
<script type="text/javascript" src="assets/js/js.js"></script>
<?php
include('includes/footer.php');
?>