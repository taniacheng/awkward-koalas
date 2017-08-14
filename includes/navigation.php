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
                <li><a href="index.php">Home</a></li>
                <li><a href="register.php">Sign Up</a></li>
                <li><a href="login.php">Sign In</a></li>
                <li><a href="account.php">My Account</a></li>
                <li><a href="logout.php">Sign Out</a></li>
                <li><a href="phpmyadmin" target="_blank">Database</a></li>
            </ul>
        </div>
        <!--end collapse-->
    </nav>
</header>