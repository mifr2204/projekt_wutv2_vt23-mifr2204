<?php
//information for database connection


session_start();
error_reporting(-1);
ini_set("display_errors", 1);



spl_autoload_register(function ($class_name) {
    include "classes/" . $class_name . ".class.php";
});

define("DBHOST", "mikki-databases-do-user-14636333-0.b.db.ondigitalocean.com"); //host
define("DBUSER", "project-wutv2"); //anvnamn
define("DBPASS", "AVNS_FXst_xk-ryGtdCjlLoK"); //password är password
define("DBPORT", 25060);
define("DBDATABASE", "project-wutv2"); //databas 


/*
return array(
    'database' => array(
        'url' => 'brtwuzhqrlbpzmhomlod-mysql.services.clever-cloud.com',
        'username' => 'uknmacdfmzjkalwj',
        'password' => '0BBHBOUT63EqXxmVK8p5',
        'port' => 3306,
        'database' => 'brtwuzhqrlbpzmhomlod'
    ),
    'session' => array(
        'timeout' => 45
    ),
    'website' => array(
        //'base_href' => 'http://localhost:8081/'
        'base_href' => 'https://studenter.miun.se/~mifr2204/moment4_vt23-mifr2204/'
    )
);
*/
//local development
/*
return array(
    'database' => array(
        'url' => '127.0.0.1',
        'username' => 'moment4_vt23',
        'password' => 'LiamMir0902',
        'port' => 3306,
        'database' => 'moment4_vt23'
    ),
    'session' => array(
        'timeout' => 45
    ),
    'website' => array(
        //'base_href' => 'http://localhost:8081/'
        'base_href' => 'https://studenter.miun.se/~mifr2204/moment4_vt23-mifr2204/'
    )
);
*/
?>