<?php
include_once('system/common.php');
include('includes/header.php');
include('includes/sidemenu.php');
include_once('includes/classes/Posts.class.php');

$userid = $_SESSION;
$posts = new Posts();

if(isset($_POST['checkboxn'])) {
    foreach($_POST['checkboxn'] as $id)
    {
        $delp = $posts->delPost($id);
    }
}


$post = $posts->userPost($userid);



if(isset($message)) {
    echo $message;
}

?>


<form action="./delete.php" method="post">
    <ul>
    
    <?php
foreach($post as $item) {
    ?>
    <input type="hidden" name="id[]" value="<?=$item['id']?>">
    <input type="checkbox" name="checkboxn[]" id="<?=$item['id']?>" value="<?=$item['id']?>">
    <li>
    <h3><?= $item['title']; ?></h3>
    <p>________________________ </p>
    <p>Skapad <?= $item['created']; ?> </p>
    <div class="by">
    <p>Av</p>
    <p class="username"> <?= $item['username'] ?></p>
    <p class="underscore">________________________ </p>
    <h4><?= $item['content']; ?></h4>
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