<?php
include_once('system/common.php');
include_once('includes/classes/Authentication.classes.php');
session_start();
session_destroy();
//authentication::destroy();
header("Location: ./login.php?action=logout");
die();
