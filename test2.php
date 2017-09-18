<?php 
    include("autoloader.php");
    
    $db = new Database();
    //$conn = $db -> getConnection();
    // if($conn) {
    //     echo "connected";
    // }
    
    //test Account -> register()
    $account = new Account();
    $login = $account -> authenticate('test4@test.com','hellothere');
    if($login) {
        echo "Success";
    }
    else {
        echo "login failed";
    }
?>