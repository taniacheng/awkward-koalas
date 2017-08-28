<?php 
//add intelligence to the navigation to show links depending on
//whether the user is logged in or not
if(!$_SESSION["email"]) {
    $navitems = array(
        "Home"=>"index.php",
        "Sign Up"=>"register.php",
        "Sign In"=>"login.php"
        );
}
else {
    $navitems = array(
        "Home"=>"index.php",
        "My Account"=>"account.php",
        "Sign Out"=>"logout.php"
        );
}

?>
<header>
    <nav class="navbar navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand">Hello</a>
             <p class="navbar-text navbar-right">
                <?php
                if($_SESSION["username"]) {
                    echo "Hello," . " " .$_SESSION["username"];
                }
                ?>
            </p>
        </div>
        <!--end navbar-header-->
        <div class="collapse navbar-collapse" id="main-menu">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                $currentpage = basename($_SERVER["REQUEST_URI"]);
                foreach($navitems as $name=>$link) {
                    if($link == $currentpage) {
                        $active = "class\"active\"";
                    }
                    else {
                        $active = "";
                    }
                    echo "<li $active><a href=\"$link\">$name</a></li>";
                }
                ?>
                <li><a href="phpmyadmin" target="_blank" rel="noopener">Database</a></li>
            </ul>
        </div>
        <!--end collapse-->
    </nav>
</header>