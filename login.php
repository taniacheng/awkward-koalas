<?php
    include("autoloader.php");
    session_start();
    
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $user = $_POST["user"];
        $password = $_POST["pass"];
        
        //instantiate account class
        $account = new Account();
        $login = $account -> authenticate($user,$password);
        
        if($login == false) {
            $errors = array();
            $errors["account"] = "Wrong credentials supplied";
        }
        else {
            header("location:account.php");
        }
    }
    //get database connection
    // include("includes/database.php");
    
    
    // if($_SERVER["REQUEST_METHOD"]=="POST") {
    //     $user_email = $_POST["user"];
    //     //check if the user entered an email address
    //     if(filter_var($user_email,FILTER_VALIDATE_EMAIL)) {
    //         //if true, user entered an email
    //          $query = "SELECT * FROM accounts WHERE email=?";
    //     }
    //     else {
    //         //if false, user entered a username
    //          $query = "SELECT * FROM accounts WHERE username=?";
    //     }
        
    //     $pass = $_POST["pass"]; // "pass" comes from the name attribute in the login form below
    //     // construct query with email variable
    //     // $query = "SELECT * FROM accounts WHERE username='$email'";
        
    //     //create array to store errors
    //     $errors = array();
        
    //     //run query
    //     $statement = $connection->prepare($query);
    //     $statement->bind_param("s",$user_email);
    //     $statement->execute();
        
    //     //get the result of the query
    //     $userdata = $statement->get_result();
        
    //     //$userdata = $connection->query($query);
        
    //     //check the result
    //     if($userdata->num_rows > 0) {
    //         $user = $userdata->fetch_assoc(); //converts result into associative array
    //         if(password_verify($pass,$user["password"])===false) {
    //             $errors["account"] = "Incorrect password or email";
    //         }
    //         else {
    //             $message = "You are now logged in";
                
    //             //create account id as a sesson variable
    //             $account_id = $user['id'];
    //             $_SESSION['id'] = $account_id;
    //             //create account username as a session variable
    //             $username = $user["username"];
    //             $_SESSION["username"] = $username;
    //             //create account email as a session variable
    //             $email = $user["email"];
    //             $_SESSION["email"] = $email;
    //         }
    //     }
    //     else {
    //         $errors["account"] = "There is no user with the supplied credentials";
    //     }
    // }
?>
<!doctype html>
<html>
    
<?php
$page_title = "Login to your account";
include("includes/head.php");
?>
    
    <body>
        <?php include("includes/navigation.php"); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form id="login-form" action="login.php" method="post">
                        <h2>Login to your account</h2>
                        <div class="form-group">
                            <label for="email">Email Address or Username</label>
                            <input  class="form-control" type="text" id="email" name="user" placeholder="you@email.com or username">
                        </div>
                        <!--end form group-->
                        <div class="form-group">
                            <label for="password">Your Password</label>
                            <input class="form-control" type="password" id="password" name="pass" placeholder="Your password">
                        </div>
                        <!--end form group-->
                        <p>Don't have an account? <a href="register.php">Sign Up</a></p>
                        <div class="text-center">
                            <button type="submit" name="submit" value="login" class="btn btn-info">Login</button>
                        </div>
                    </form>
                    <?php 
                    if(count($errors) > 0 || $message) {
                        //see which class to be used with alert
                        if(count($errors) > 0) {
                            $class="alert-warning";
                            $feedback = implode(" ",$errors);
                        }
                        if($message) {
                            $class="alert-success";
                            $feedback="$message";
                        }
                        echo "<div class=\"alert $class\">
                        $feedback
                        </div>";
                    }
                    ?>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </body>
    
</html>