<?php
include_once('system/common.php');
include('includes/header.php');
include('includes/sidemenu.php');

include_once('includes/classes/News.class.php');
$news = news::get_latest();

include('includes/articleinclude.php');

include('includes/footer.php');