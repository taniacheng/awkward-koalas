<?php 
include("database.php");
//query to create an account
$username   = "jane88";
$email      = "jane88@gmail.com";
$password   = password_hash("password", PASSWORD_DEFAULT);
$account_query = "INSERT INTO accounts (username,email,password,status,created) VALUES('$username','$email','$password',1, NOW())";
//run the query
$result = $connection->query($account_query);
if(!$result) {
    echo "Account creation failed";
}
?>

<!doctype html>
<html>
   <?php
   $page_title = "Home Page";
   include("includes/head.php"); 
   ?>
    
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <h1><i class="fa fa-hand-peace-o" aria-hidden="true"></i>
 Hello!</h1>
                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum
                    soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut
                    officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis
                    voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat
                </div>
                <div class="col-sm-6 col-md-6">
                    <h1><i class="fa fa-handshake-o" aria-hidden="true"></i>
 Goodbye...</h1>
                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum
                    soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut
                    officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis
                    voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
                </div>
            </div>
        </div>
    </body>
</html>