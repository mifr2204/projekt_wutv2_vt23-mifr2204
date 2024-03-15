<?php 
    include_once('includes/classes/Posts.class.php');
    include_once('system/config.php');
    
?>

<section class="mid">
        <div class="container">
            <nav class="sidebar">
                <ul>
                    <li>
                        <a href="./index.php">Startsidan</a>
                    </li>
<?php

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
    

//if loged in returns other navs
if(isset($_SESSION['username'])) {
?>
    <li>
        <a href="./logout.php">Logga ut</a>
    </li>
<?php
} else
{
?>
    <li>
        <a href="./login.php" >Logga in</a>      
    </li>
        
<?php
} //FIX me ta bort logga in på sidemeny när inloggad, lägg till logga ut 
?>
                </ul>
            </nav>

<script type="text/javascript" src="assets/js/js.js"></script>



