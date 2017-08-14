<?php 
session_start();

include("includes/database.php");

if(isset($_SESSION["email"])==false) {
    //user has not logged in redirect to login page
    header("location:login.php");
    exit();
}

//Get data for countries select
$countries_query = "SELECT id,country_code,country_name FROM Countries";
$countries_result = $connection->query($countries_query);
if($countries_result->num_rows > 0) {
    $countries = array();
    while($row = $countries_result->fetch_assoc()) {
        array_push($countries,$row);
    }
}
//Get users details
$account_id = $_SESSION["id"];
$user_query = "SELECT 
                accounts.email AS email,
                accounts.username AS username,
                accounts.email AS email,
                user_details.first_name AS firstname,
                user_details.last_name AS lastname,
                user_details.unit_number AS unit,
                user_details.street_name AS street,
                user_details.suburb AS suburb,
                user_details.state AS state,
                user_details.postcode AS postcode,
                user_details.country AS country
                FROM accounts LEFT JOIN user_details ON accounts.id = user_details.account_id WHERE accounts.id =?";
$statement = $connection->prepare($user_query);
$statement->bind_param("i", $_SESSION["id"]);
$statement->execute();
$result = $statement->get_result();
$userdata = $result->fetch_assoc();
?>
<!doctype html>
<html>
    <?php include("includes/head.php"); ?>
    
    <body>
        <?php include("includes/navigation.php"); ?>
        <div class="container">
            <form id="account-update" action="account.php" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Account Details</h2>
                        
                            <div class="form-group">
                                <label for="username">Username</label>
                                <?php 
                                $username = $userdata["username"];
                                ?>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                            </div>
                            <!--end form group-->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <?php 
                                $email = $userdata["email"];
                                ?>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                            </div>
                            <!--end form group-->
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password1" name="password1">
                            </div>
                            <!--end form group-->
                            <div class="form-group">
                                <label for="password">Re-type New Password</label>
                                <input type="password" class="form-control" id="password2" name="password2">
                            </div>
                            <!--end form group-->
                    </div>
                    <!--end col-->
                    <div class="col-md-6">
                        <h2>Personal Details</h2>
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" class="form-control" id="first-name" name="first-name" placeholder="First Name">
                        </div>
                        <!--end form group-->
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Last Name">
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="unit-number">Unit</label>
                                    <input type="text" class="form-control" id="unit-number" name="unit-number" placeholder="5">
                                </div>
                            </div>
                            <!--end unit number-->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="street-number">Number</label>
                                    <input type="text" class="form-control" id="street-number" name="street-number" placeholder="42">
                                </div>
                            </div>
                            <!--end street number-->
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="street-name">Street</label>
                                    <input type="text" class="form-control" id="street-name" name="street-name" placeholder="Nice St">
                                </div>
                            </div>
                            <!--end street name-->
                        </div>
                        <!--end row-->
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="suburb">Suburb</label>
                                    <input type="text" class="form-control" id="suburb" name="suburb" placeholder="Happyville">
                                </div>
                            </div>
                            <!--end suburb-->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state" placeholder="Queensland">
                                </div>
                            </div>
                            <!--end state-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="postcode">Postcode</label>
                                    <input type="text" class="form-control" id="postcode" name="postcode" placeholder="4967">
                                </div>
                            </div>
                            <!--end postcode-->
                        </div>
                        <!--end row-->
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select id="country" class="form-control">
                                <?php
                                    $default_country_code="AU";
                                    foreach($countries as $country) {
                                        $name = $country["country_name"];
                                        $code = $country["country_code"];
                                        $id = $country["id"];
                                        if($code == $default_country_code) {
                                            $selected = "selected";
                                        }
                                        else {
                                            $selected = "";
                                        }
                                        echo "<option data-id=\"$id\" $selected value=\"$country\">$name ($code)</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <!--end container-->
    </body>
</html>