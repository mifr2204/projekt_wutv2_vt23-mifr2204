<?php
include_once('system/common.php');
include('includes/header.php');
include('includes/sidemenu.php');
include_once('includes/classes/Post.class.php');
include_once('includes/classes/User.class.php');


$loggedInUser = User::getLoggedInUser();


$page = 1;
if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
}

$pagesize = 2;
if (isset($_GET['pagesize'])) {
    $pagesize = intval($_GET['pagesize']);
}

if (isset($_GET['userid'])) {
    $user = User::getUnique(intval($_GET['userid']));
} else {
    $user = User::getLoggedInUser();
}


$posts = $user->getPosts($page, $pagesize);



?>
<table class="table"style="width: 100%;" width="100%">
    <thead>
        <th>
            Titel
        </th>
        <th>
            Skapad
        </th>
        <th>
            Innehåll
        </th>
        <th></th>
    </thead>
    <tbody>
<?php
foreach($posts as $post) {
    ?>

<tr>
    <td>
        <?= mb_strimwidth($post->title, 0, 50, "..."); ?>
    </td>
    <td>
        <?= $post->created; ?>
    </td>
    <td>
        <?= mb_strimwidth($post->content, 0, 50, "..."); ?>
    </td>
    <td>
        <a class="readbtn" href="./posts.php?id=<?= $post->id; ?>">Läs mer</a>
        <?php
        if ($loggedInUser->id === $user->id)
        {
        ?>
        |
        <a class="changebtn" href="./changePost.php?id=<?= $post->id; ?>">Ändra</a>
        <?php
        }
        ?>
    </td>
</tr>
    
    <?php
}

?>
    </tbody>
</table>


Sida:
<ul>
<?php
$numberOfPages = Post::postPagesByUserId($user->id, $pagesize);
if ($page == 1) {
    echo '<li>|<</li>';
} else {
    echo '<li><a href="?page=1">|<</a></li>';
}
for ($i = 1; $i <= $numberOfPages; $i++) {
    echo '<li>';
    if ($i == $page) {
        echo $i;
    } else {
        echo '<a href="?page=' . $i . '">' . $i . '</a>';
    }
    echo '</li>';
}
if ($page == $numberOfPages) {
    echo '<li>>|</li>';
} else {
    echo '<li><a href="?page=' . $numberOfPages . '">>|</a></li>';
}
?>
</ul>


<?php



//navcont och last ska vara lika typ


include('includes/footer.php');
?>