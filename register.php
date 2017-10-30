<?php
session_start();
include("includes/database.php");
// PROCESS REGISTRATION WITH PHP
// print_r($_SERVER);
if($_SERVER["REQUEST_METHOD"]=="POST"){
  // print_r($_POST);
  //get data from the form (each input's name attribute becomes $_POST["attribute_value"])
  $errors = array();
  $username = $_POST["username"];
  //check username for errors
  if(strlen($username) > 16){
    //create error message
    $errors["username"] = "username too long";
  }
  if(strlen($username) < 6){
    $errors["username"] = $errors["username"] . " " . "username should be at least 6 characters";
  }
  if($errors["username"]){
    $errors["username"] = trim($errors["username"]);
  }
  
  $email = $_POST["email"];
  //check and validate email
  $email_check = filter_var($email,FILTER_VALIDATE_EMAIL);
  if($email_check==false){
    $errors["email"] = "email address is not valid";
  }
  
  $password1 = $_POST["password1"];
  $password2 = $_POST["password2"];
  if($password1 !== $password2){
    $errors["password"] = "passwords are not equal";
  }
  elseif(strlen($password1) < 8){
    $errors["password"] = "password should be at least 8 characters";
  }
  
  //if no errors write data to database
  if(count($errors)==0){
    //hash the password
    $password = password_hash($password1,PASSWORD_DEFAULT);
    
    //The best way to create safe query is to use parameterised query
    $query = "INSERT 
              INTO accounts 
              (username,email,password,status,created)
              VALUES 
              (?,?,?,1,NOW())";
    
    
    //send query to the database using prepare()
    $statement = $connection->prepare($query);
    
    //bind the variables to the query using bind_param
    //bind param also requires a string filled with:
    //"s" for string
    //"i" for integer
    //"d" for double (sometimes called float)
    //"b" for blob (for binary data, such as images or video files)
    //since all three variables are string, the parameter is "sss"
    $statement->bind_param("sss",$username,$email,$password);
    
    //$result = $connection->query($query);
    $statement->execute();
    //$result = $statement->get_result();
    
    if($statement->affected_rows > 0){
      //echo "account created";
      $message = "Account successfully created";
      
      //log user in after account is created
      //get the id of the last record inserted
      $userid = $connection->insert_id;
      //create session variables
      $_SESSION["id"] = $userid;
      $_SESSION["email"] = $email;
      $_SESSION["username"] = $username;
    }
    else{
      //if not successful, check for duplicates
      if($connection->errno == 1062){
        $errormsg = $connection->error;
        //check if error contains "username" (the column name)
        if(strstr($errormsg,"username")){
          $errors["username"] = "username already taken";
        }
        //check if error message contains "email" (the column name)
        if(strstr($errormsg,"email")){
          $errors["email"] = "email already used";
        }
        
      }
    }
  }
}
?>
<!doctype html>  
<html>
<?php
$page_title = "Register For Account";
include("includes/head.php");
?>
<body>
  <?php include("includes/navigation.php"); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <form id="registration" action="register.php" method="post">
          <h2>Register for an account</h2>
          <!--username-->
          <?php
          if($errors["username"]){
            $username_error_class = "has-error";
          }
          ?>
          <div class="form-group <?php echo $username_error_class; ?>">
            <label for="username">Username</label>
            <input class="form-control" name="username" type="text" id="username" placeholder="minimum 6 characters" value="<?php echo $username; ?>">
            <span class="help-block">
              <?php echo $errors["username"]; ?>
            </span>
          </div>
          <!--email-->
          <?php 
          if($errors["email"]){
            $email_error_class = "has-error";
          }
          ?>
          <div class="form-group <?php echo $email_error_class; ?>">
            <label for="email">Email</label>
            <input class="form-control" name="email" type="email" id="email" placeholder="you@domain.com" value="<?php echo $email; ?>">
            <span class="help-block">
              <?php echo $errors["email"]; ?>
            </span>
          </div>
          <!--password-->
          <?php 
          if($errors["password"]){
            $password_error_class = "has-error";
          }
          ?>
          <div class="form-group <?php echo $password_error_class; ?>">
            <!--password 1-->
            <label for="password1">Password</label>
            <input  class="form-control" name="password1" type="password" id="password1" placeholder="minimum 8 characters">
            <!--password 2-->
            <label for="password2">Retype Password</label>
            <input  class="form-control" name="password2" type="password" id="password2" placeholder="retype password">
            <span class="help-block">
              <?php
              echo $errors["password"];
              ?>
            </span>
          </div>
          <p>Have an account? <a href="login2.php">Sign In</a></p>
          <div class="text-center">
            <button type="submit" class="btn btn-default">Register</button>
          </div>
          <?php
          if($message){
            echo "<div class=\"alert alert-success\">
            $message</div>";
          }
          ?>
        </form>
      </div>
    </div>
  </div>
</body>
</html>