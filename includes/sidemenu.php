<?php 
    include_once('system/config.php');
    include_once('includes\classes\User.class.php');
?>

<section class="mid">
        
        <nav class="sidebar">
            
            <ul>
                <li>
                    <a class="mainmen" href="./index.php">Startsidan</a>
                </li>
                
<?php
//if loged in returns other navs
if(isset($_SESSION['username'])) {
    ?>
        <li>
            <a class="mainmen" id="logoutbtn" href="./logout.php">Logga ut</a>
        </li>
    <?php
    } else
    {
    ?>
        <li>
            <a class="mainmen" id="loginbtn" href="./login.php" >Logga in</a>      
        </li>
         
    <?php
    }
    
    if(isset($_SESSION['username'])) { 
        ?>
            <li>
            <a href="#" id="blogglink" >BLOGG MENY &dArr;</a>
            </li>
            <li>
            <a class="submenu" id="alllink" href="./userpost.php" >alla mina INLÄGG</a>
            </li>
            <li>
            <a class="submenu" id="createlink" href="./create.php" >SKAPA INLÄGG</a>
            </li>
            <li>
            <a class="submenu" id="deletelink" href="./delete.php" >RADERA INLÄGG</a>
            </li>
        <?php
    }
    

 //FIX me ta bort logga in på sidemeny när inloggad, lägg till logga ut 
?>
        </ul>
<?php
        $users = User::allUsers();//skapar en instans av user med alla users GG
    ?>
    <div class="users">
        <ul>
        <li>
            <a href="#" id="userlistbtn" >Andvändare &dArr;</a>
        </li>
    <?php
        foreach($users as $user) {
            $numerOfPosts = Post::countPostsByUserId($user->id);
    ?>
            <li><a class="submenu" class="button" class="userlist" href="./userpost.php?userid=<?= $user->id; ?>"><?= $user->username; ?> (<?= $numerOfPosts; ?>)</a></li>   
    <?php
        }
    ?>
        </ul>
    </div>
            </nav>
        <div class="container">

<script type="text/javascript" src="assets/js/js.js"></script>



