<?php
include_once('system/common.php');
include('includes/header.php');
include('includes/sidemenu.php');
include_once('includes/classes/News.class.php');

//shows a specific article
if (isset($_REQUEST['id'])) {
    $id = intval($_REQUEST['id']);
    $article = news::get_by_id($id);
    $author = $article->author();
}
?>

<nav class="breadcrumbs">
    <ul>
        <li>
            <a href="./news.php">Nyheter</a>
        </li>
        <li>
            <span>
                <?=$article->title?>
            </span>
        </li>
    </ul>
</nav>

<article>
    <h2 class="caption"><?=$article->title?></h2>
    <div class="subcaption">
        <?=date('Y-m-d H:i', intval($article->post_date))?> | <?=$author->username?>
    </div>
    <p>
        <?=$article->content?>
    </p>
</article>

<?php
include('includes/footer.php');