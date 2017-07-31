<?php
include("includes/database.php");
// PROCESS REGISTRATION WITH PHP
if($_SERVER["REQUEST_METHOD"]=="POST") {
  // get data from the form (each input's name attribute becaomes $_POST["attribute_value"])
  $errors   = array();
  $username = $_POST["username"];
  //check for username errors
  if(strlen($username)>16) {
    //create error message
    $errors["username"] = "Username exceeds the maximum characters";
  }
  if(strlen($username)<6) {
    $errors["username"] = $errors["username"] . " " . "Username should be at least 6 characters"; //Concatenates the two error messages
  }
  if($errors["username"]) {
   trim($errors["username"]); //Removes spaces at end or beginning of error messages 
  }
  
  $email = $_POST["email"];
  //Check and validate email
  $email_check = filter_var($email,FILTER_VALIDATE_EMAIL);
  if($email_check==false) {
    $errors["email"] = "Email address is not valid";
  }
  
  $password1 = $_POST["password1"];
  $password2 = $_POST["password2"];
  if($password1 !== $password2) {
    $errors["password"] = "Passwords do not match";
  }
  elseif(strlen($password1) < 8) { 
    $errors["password"] = "Password should be at least 8 characters";
  }
  //if no errors, write data to database
  if(count($errors)==0) {
    //hash the password
    $password = password_hash($password,PASSWORD_DEFAULT);
    //create a query string
    $query = "INSERT 
              INTO accounts (username,email,password,status,created)
              VALUES
              ('$username','$email','$password',1,NOW())";
    $result = $connection->query($query);
    if($result==true) {
      echo "Account created";
    }
    else {
      if($connection->errno == 1062) {
        $message = $connection->error;
        //check if error contains 'username'
        if(strstr($message,"username")) {
          $errors["username"] = "Username already exists";
        }
        //check if error contains 'email'
        if(strstr($message,"email")) {
          $errors["email"] = "Email address already exists";
        }
      }
    }
  }
}
?>
<!doctype html>
<html>
<?php
$page_title = "Register for account";
include("includes/head.php");
?>
 
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
      
        <form id="registration" action="register.php" method="post">
          <h2>Register for an account</h2>
          <!--username-->
          <?php
            if($errors["username"]) {
              $username_error_class = "has-error";
            }
          ?>
          <div class="form-group <?php echo $username_error_class; ?>">
            <label for="username">Username</label>
            <input class="form-control" name="username" type="text" id="username" placeholder="Minimum 6 characters" value="<?php echo $username; ?>">
            <span class="help-block">
              <?php echo $errors["username"]; ?>
            </span>
          </div>
          <!--email-->
          <?php 
            if($errors["email"]) {
              $email_error_class = "has-error";
            }
          ?>
          <div class="form-group <?php echo $email_error_class; ?>">
            <label for="email">Email</label>
            <input class="form-control" name="email" type="email" id="email" placeholder="you@yourdomain.com" value="<?php echo $email; ?>">
            <span class="help-block">
              <?php echo $errors["email"]; ?>
            </span>
          </div>
          <!--password-->
         <?php 
            if($errors["password"]) {
              $password_error_class = "has-error";
            }
          ?>
          <div class="form-group <?php echo $password_error_class; ?>">
            <!--password 1-->
            <label for="password1">Password</label>
            <input class="form-control" name="password1" type="password" id="password1" placeholder="Minimum 8 characters">
            <!--password 2-->
            <label for="password2">Password</label>
            <input class="form-control" name="password2" type="password" id="password2" placeholder="Retype password">
            <span class="help-block">
              <?php echo $errors["password"]; ?>
            </span>
          </div>
          <!--Submit-->
          <div class="text-center">
            <button type="submit" class="btn btn-default">Register</button>
          </div>
          </form>
        <!--end registration form-->
      
      </div>
      <!--end column-->
    </div>
    <!--end row-->
  </div>
  <!--end container-->

</body>
</html>