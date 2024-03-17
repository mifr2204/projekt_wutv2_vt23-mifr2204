<?php
include_once('system/common.php');
include_once('includes/classes/Post.class.php');

include('includes/header.php');



$posts = Post::allPostsWithLimit(5); //skapar en instans av posts med alla posts GG
//FIX ME  fixa så blogginläggen sorteras eller hamnar på flera sidor, ev visa hela och ta bort visa mer? visa smakprover?  
?>
    <h1>Blogginlägg</h1>

</div>
    </section>

<main >
    
    <?php
    include('includes/sidemenu.php');
    foreach($posts as $post) {
    ?>
        <article>

        <h2><?= $post->title; ?></h2>

        <p class="crebyp">Skapad <?= $post->created; ?> </p>
        <div class="by">
            <p>Av:: </p>
            <p class="username"> <?= $post->getUser()->username;?> </p>
        </div>
 
        <p><?= $post->content; ?></p>
        </article>
    <?php
    }

?>

</main>
<?php

include('includes/footer.php');
?>