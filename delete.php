<?php
include_once('system/common.php');
include('includes/header.php');
include('includes/sidemenu.php');
include_once('includes/classes/Post.class.php');
include_once('includes/classes/User.class.php');


if(isset($_POST['checkboxn'])) {
    foreach($_POST['checkboxn'] as $id)
    {
        $post = Post::getUnique($id);
        $post->delete();
    }
}

$user = User::getLoggedInUser();
$posts = $user->getPosts();



if(isset($message)) {
    echo $message;
}

?>


<form action="./delete.php" method="post">
    <ul>
    
    <?php
foreach($posts as $post) {
    ?>
    <input type="hidden" name="id[]" value="<?=$post->id?>">
    <input type="checkbox" name="checkboxn[]" id="<?=$post->id?>" value="<?=$post->id?>">
    <li>
    <h3><?= $post->title; ?></h3>
    <p>________________________ </p>
    <p>Skapad <?= $post->created; ?> </p>
    <div class="by">
    <p>Av</p>
    <p class="username"> <?= $user->username; ?></p>
    <p class="underscore">________________________ </p>
    <h4><?= $post->content; ?></h4>
    </li>
    </ul>
    <?php
}

/*
foreach($post as $item) {
    if(isset($_POST['checkboxn'])) {
       echo $item['id'];

        $id = $item['id'];
       // echo $id;
        //$postToDel = $_POST['checkboxn'];
        //foreach($postToDel as $item){    

            
          
             $delp = $posts->delPost($id);
           
        //}
    }
}
*/
?>
    
    <div class="form-field">
        <input id="deletebtn" type="submit" value="Ta bort inlägg" />
    </div>
    
</form>

<?php

//navcont och last ska vara lika typ


include('includes/footer.php');
?>