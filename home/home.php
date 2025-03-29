<?php
require_once "../config/database.php";


if(!empty($_SESSION['user_id']))
{
    $check = 1;
    //echo "yes";
}
else{
    $check = 0;
    //echo "no user id";
}

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Movie Search
                <div class="loginbtn">
                    <ul class="ul1">
                        <?php if ($check == 1): ?>
                            <li class="li1"><a href="../auth/logout.php" class="homelink">Logout</a></li>
                        <?php else: ?>
                            <li class="li1"><a href="../auth/login.php" class="homelink">Login</a></li>
                            <li class="li1"><a href="../auth/register.php" class="homelink">Sign In</a></li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="home-img-container">
            <h1 class="login-title">Welcome to the World Of Cinema</h1>
            <img src="https://koditips.com/wp-content/uploads/hd-movies-tool.jpg" alt="Homepage Image" class="home-img" />
        </div>

        <?php if ($check == 1): ?>
            <h1 class="login-title">Movie Search App</h1>
            <div class="search-container">
                <input type="text" id="search" placeholder="Enter movie title" class="movie-search-input">
                <button id="searchBtn" class="movie-search-btn">Search</button>
            </div>

            <div id="results" class="result-container"></div>
        <?php endif ?>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>
