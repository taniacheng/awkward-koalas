<?php
include("../autoloader.php");

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = $_POST["user"];
    $password = $_POST["password"];
    
    $data = array();
    // $errors = array();
    
    $account = new Account();
    $auth_state = $account -> authenticate($user,$password);
    
    //if auth is successful
    if($auth_state){
        $data["userid"] = $account -> getAccountId();
        $data["success"] = true;
    }
    else{
        $data["success"] = false;
    }
    echo json_encode($data);
}
?>