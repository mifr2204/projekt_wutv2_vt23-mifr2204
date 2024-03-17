<?php
include_once('system/common.php');
include_once('includes/classes/User.class.php');

User::logout();
header("Location: ./login.php?action=logout");
die();
