<?php
    include("autoloader.php");
    session_start();
    
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
        <script src="js/login.js"></script>
    </body>
    
</html>

<template id="login-template">
    <div class="alert alert-dismissable">
        <button class="close" type="button" data-dismiss="alert">&times;</button>
        <p class="message"></p>
    </div>
</template>