<?php
//shows articles
foreach ($news as $article)
{
    $author = $article->author();
    echo '<article>';
    echo '<h3>' . $article->title . '</h3>';
    echo '<div class="subcaption">';
    echo date('Y-m-d H:i', intval($article->post_date));
    echo ' | ';
    echo $author->username;
    echo '</div>';
    echo '<p>';
    echo substr($article->content, 0, 500);
    if (strlen($article->content) > 500) {
        echo ' ...';
    }
    echo '</p>';
    echo '<a href="./article.php?id=' . $article->id . '">Läs mer</a>';
    echo '</article>';
}