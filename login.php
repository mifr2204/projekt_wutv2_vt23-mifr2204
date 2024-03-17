<?php
include('includes/header.php');
include_once('includes/classes/User.class.php');
include_once('system/common.php');
/*
if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username === "blogg" && $password === "password") {
        $_SESSION['username'] = $username;
        header("location: ./blogg.php");
    } else {
        $message = "<div class='alert'>Fel användarnamn eller lösenord</div>";
    }
}
*/

if(isset($_POST['username']) && isset($_POST['password'])) {

    try {
        $user = User::tryLogin($_POST['username'], $_POST['password']);
        header("Location: ./index.php");
        die();
    } catch (Exception $e) {
        $message = '<div class="alert">' . $e->getMessage() . '</div>';
    }
}




//if(isset($_GET[$message = "<div class='alert'>" . $_GET['message'] . "</div>"]));
//FIXME?


//login or warns that it is wrong usernme or password
/*if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] && $_POST['password']) {
        include_once('includes/classes/Authentication.class.php');
        $result = authentication::authenticate($_POST['username'], $_POST['password']);
        if ($result) {
            header("Location: ./blogg.php");
            die();
        }
        else {
            echo '<div class="status red">⚠️ Fel användarnamn och/eller lösenord.</div>';
        }
    }
}
*/
//logout 
if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'logout') {
    echo '<div class="status">✔️ Du har nu loggat ut.</div>';
}

?>
  <h1>Logga in</h1>

</div>
    </section>

<main id="loginmain">
<?php
include('includes/sidemenu.php');
?>
    <form id="loginform" action="./login.php" method="post">
        <div class="form-field">
            <label for="username">Användarnamn</label>
            <input type="text" name="username" id="username" />
        </div>
        <div class="form-field">
            <label for="password">Lösenord</label>
            <input type="password" name="password" id="password" />
        </div>
        <?php
            if(isset($message)) {
                echo $message;
            }
        ?>
        <div class="form-field">
            <input type="submit" value="Logga in" />
        </div>

        <div class="form-field">
            <p>Har du inget konto? Skapa ett <a href="./newuser.php">HÄR</a></p>
        </div>
    </form>
</main>
<?php
include('includes/footer.php');