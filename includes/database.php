<?php
    $dbhost = getenv("dbhost");
    $dbuser = getenv("dbuser");
    $dbpassword = getenv("dbpassword");
    $dbdatabase = getenv("dbname");
    $connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbdatabase);
    
    if(!$connection) {
        echo "database error";
    }
?>