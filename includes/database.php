<?php
    $user       = "user";
    $dbpassword   = "password";
    $host       = "localhost";
    $database   = "datastore";
    $connection = mysqli_connect($host, $user, $dbpassword, $database);
    
    if(!$connection) {
        echo "database error";
    }
?>