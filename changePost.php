

<?php
include_once('includes/classes/User.class.php');
include_once('includes/classes/Post.class.php');
include_once('system/common.php');
include_once('system/config.php');
include('includes/header.php');
include('includes/sidemenu.php');
    
 
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("location: ./index.php");
}

$post = Post::getUnique($id);
?>
<?php


        if(isset($_POST['title'])) {
        
            $title = $_POST['title'];
            $content = $_POST['content'];
    
            try {
                $post = Post::newPost($newPostArgs);
                $message = "<div class='status'>✔️ Sidan är skapad</div>";
                ?>
                <a href="./create.php">Skapa Nytt inlägg</a>
                <?php
            } catch (Exception $e) {
                $message = "<div class= 'alert'>Sidan kunde ej skapas</div>";
            }
        

            if($posts->changePost($id, $title, $content)) {
                $message = "<div class='status'>✔️ Inlägget är uppdaterat</div>";
                ?>
                <?php
            }else {
                $message = "<div class= 'alert'>Inlägget kunde ej uppdateras</div>";
            }
        }

        if(isset($message)) {
            echo $message;
        }

?>
<?php
$post = $posts->getPost($id);




?>
<h2>Redigera Blogginlägg</h2>


<div id="id">
<?= $id; ?>
</div>
<?php

?>
<div id="createForm">
    <form action="./changePost.php?id=<?php echo $_GET['id']; ?>" method="post">
        <div class="form-field">
            <label for="title">Titel</label>
            <input type="text" name="title" id="title" value="<?= $post['title']; ?>"/>
        </div>
        <div class="form-field">
            <label for="content">Innehåll</label>
            <textarea name="content" id="content" rows="15"><?= $post['content']; ?></textarea>
        </div>

        <div class="form-field">
            <input id="createbtn" type="submit" value="Uppdatera Inlägg" />
        </div>
    </form>
</div>
<?php


?>





////////

   $posts = new Posts(); 

?>



<script>
    CKEDITOR.replace( 'content' );
</script>
<script type="text/javascript" src="assets/js/js.js"></script>
<?php
include('includes/footer.php');
?>


<?php
/*
include_once('includes/classes/Authentication.class.php');
include_once('includes/classes/News.class.php');
if (!authentication::is_authenticated())
{
    die('Du har inte rättigheter att visa denna sida.');
}

include('includes/header.php');
include('includes/sidemenu.php');
?>

<h2>blogg</h2>


<?php
//returns notes for created and deleted
if (isset($_REQUEST['status']) && $_REQUEST['status'] === 'created') {
    echo '<div class="status">✔️ Nyhet har skapats.</div>';
}

if (isset($_REQUEST['status']) && $_REQUEST['status'] === 'confirmed') {
    echo '<div class="status">✔️ Vald artikel har raderats.</div>';
}
//delete articles
if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'delete' && isset($_REQUEST['id'])) {
    $article_to_delete = news::get_by_id(intval($_REQUEST['id']));

    if (isset($_POST['confirm'])) {
        $article_to_delete->delete();
        header("Location: ./blogg.php?status=confirmed");
        die();
    }

?>
<div class="modal">
    <h3 class="caption">Bekräfta</h3>
    <div class="content">
        Bekräfta att du vill radera artikel "<?=$article_to_delete->title?>"?
    </div>
    <form action="./blogg.php?action=delete&id=<?=$_REQUEST['id']?>" method="post">
        <input type="submit" name="confirm" value="Bekräfta" class="primary" />
        <a href="./blogg.php" class="button">Avbryt</a>
    </form>
</div>
<?php
}
?>


<table class="table" >
    <tr>
        <th>
            Artikel
        </th>
        <th>
        </th>
    </tr>
<?php
$news = news::get_latest();
//shows articles
foreach ($news as $article)
{
    echo '<tr>';
    echo '<td>' . $article->title . '</td>';
    echo '<td><a href="./article.php?id=' . $article->id . '">Visa nyhet</a></td>';
    echo '<td><a href="./blogg.php?action=delete&id=' . $article->id . '">Radera</a></td>';
    echo '</tr>';
}
?>
</table>

<section class="divider">
    <h3>Skapa nyhet</h3>
<?php
//warnings when crete article is not preformed correcly else creates one
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'create') {
    if (strlen($_POST['title']) < 5) {
        echo '<div class="status red">⚠️ Titel måste innehålla fler än 5 tecken.</div>';
    }
    else if (strlen($_POST['content']) < 50) {
        echo '<div class="status red">⚠️ Innehåll måste innehålla fler än 50 tecken.</div>';
    }
    else {
        news::create($_POST['title'], $_POST['content'], authentication::current_user()->id);
        header("Location: ./blogg.php?status=created");
        die();
    }
}
?>
    <form action="./blogg.php?action=create" method="post">
        <div class="form-field">
            <label for="title">Titel</label>
            <input type="text" name="title" id="title" value="<?=(isset($_POST['title'])) ? $_POST['title'] : ''?>" />
        </div>
        <div class="form-field">
            <label for="content">Innehåll</label>
            <textarea name="content" id="content" rows="5"><?=(isset($_POST['content'])) ? $_POST['content'] : ''?></textarea>
        </div>
        <div class="form-field">
            <input type="submit" value="Skapa" class="primary" />
        </div>
    </form>
</section>

<?php
include('includes/footer.php');
*/
?>