<?php
include('includes/header.php');
include('includes/sidemenu.php');
include_once('system/common.php');
include_once('includes/classes/User.class.php');

?>


<h2>Skapa konto</h2>

<?php
$showform = true;
$displaybutton = false;

if(isset($_POST['email'])) {
    $newUserArgs = array('forname' => $_POST['forname'], 'lastname' => $_POST['lastname'], 'email' => $_POST['email'], 'username' => $_POST['username'], 'password' => $_POST['password']);

    if ($_POST['password'] != $_POST['password2']) {
        $message = '<div class="alert">Lösenord och bekräftat lösenord stämmer inte överens.</div>';
    } else {
        try {
            $user = User::newUser($newUserArgs);
            $showform = false;
            $message = "<div class='status'>✔️ Andvändaren är skapad</div>";
            $displaybutton = true;
        } catch (Exception $e) {
            $message = '<div class="alert">' . $e->getMessage() . '</div>';
        }
    }

}


if ($showform) {
    ?>
<form action="./newuser.php" method="post">


<div class="form-field">
    <label for="forname">Förnamn</label>
    <input type="text" name="forname" id="forname" />
</div>
<div class="form-field">
    <label for="lastname">Efternamn</label>
    <input type="text" name="lastname" id="lastname" />
</div>
<div class="form-field">
    <label for="email">E-mail</label>
    <input type="text" name="email" id="email" />
</div>
<div class="form-field">
    <label for="username">Användarnamn</label>
    <input type="text" name="username" id="username" />
</div>
<div class="form-field">
    <label for="password">Lösenord</label>
    <input type="password" name="password" id="password" />
</div>
<div class="form-field">
    <label for="password2">Bekräfta lösenord</label>
    <input type="password" name="password2" id="password2" />
</div>
<div class="form-field">
    <input type="submit" value="Skapa Konto" />
</div>

</form>
    <?php
}
//fix me skapa verify password så båda är lika, 
    if(isset($message)) {
        echo $message;
    }
    /*
    if($displaybutton) {
        ?>
            <a id="toLgInBtn" href="./login.php">Till Logga in</a>
        <?php
    }
*/
    ?>

<?php
include('includes/footer.php');

?>