<?php
/*
include_once('includes/classes/User.class.php');
class authentication {
    
    //Controlls username and password against the database
    public static function authenticate($username, $password) {
        $result = user::get_by_username_and_password($username, $password);
        if ($result) {
            $config = include('system/config.php');
            setCOOKIE("username", $result->username, time() + (intval($config['session']['timeout']) * 60),'/');
            setCOOKIE("userid", $result->id, time() + (intval($config['session']['timeout']) * 60),'/');
        }
        return $result;
    }
    //Resets the auto logout when a post is refeshed 
    public static function refresh_expires() {
        if (!isset($_COOKIE['username']) || !isset($_COOKIE['userid'])) {
            return;
        }
        $config = include('system/config.php');
        setCOOKIE("username", $_COOKIE['username'], time() + (intval($config['session']['timeout']) * 60),'/');
        setCOOKIE("userid", $_COOKIE['userid'], time() + (intval($config['session']['timeout']) * 60),'/');
}
    //indicates if one is loged in or not 
    public static function is_authenticated() {
        return (isset($_COOKIE['username']) && isset($_COOKIE['userid']));
    }
    //logout
    public static function destroy() {
        setCOOKIE("username", false, time() - 360,'/');
        setCOOKIE("userid", false, time() - 360,'/');
    }
    //gives the correct data for the user 
    public static function current_user() {
        if (!authentication::is_authenticated()) {
            return false;
        }
        include_once('includes/classes/User.class.php');
        return user::get_by_id(intval($_COOKIE['userid']));
    }
}
*/
?>