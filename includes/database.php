<?php
    $user       = "user";
    $password   = "password";
    $host       = "localhost";
    $database   = "datastore";
    $connection = mysqli_connect($host, $user, $password, $database);
    
    if(!$connection) {
        echo "database error";
    }
?>