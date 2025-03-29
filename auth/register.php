<?php
require_once "../config/database.php";
require_once "signincode.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type = "text/css" href = "../css/style.css">
    </head>
    <body>
        <div class = "container">
            <div class = "header">
                <div class = "logo">Movie Search
                    <div class = "loginbtn">
                        <ul class = "ul1">
                            <li class = "li1"><a href = "../home/home.php" class = "homelink">Home</a></li>
                            <li class = "li1"><a href = "login.php" class = "homelink">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class = "gallery">
                <div class = "logindiv">
                <h1 class="login-title">Sign In Page</h1>    
                <?= $messageSuccess ? '<div class="message-success">' . $messageSuccess . '</div>' : '' ?>
			    <?= $messageError ? '<div class="message-error">' . $messageError . '</div>' : '' ?>
			<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <table class = "signintbl">
                        <tr>
                            <td><label>Name :</label></td>
                            <td><input type = "textfield" name = "signinname" class ="signinput">
                            <span class = "error"><?=$nameErr; ?></span></td>
                        </tr>
                        <tr>
                            <td><label>Email :</label></td>
                            <td><input type = "textfield" name = "signinemail" class ="signinput">
                            <span class = "error"><?=$emailErr; ?></span></td>
                        </tr>
                        <tr>
                            <td><label>Password :</label></td>
                            <td><input type = "password" name = "signinpassword" class ="signinput">
                            <span class = "error"><?=$passwordErr; ?></span></td>
                        </tr>
                        <tr>
                            <td><label>Confirm Password :</label></td>
                            <td><input type = "password" name = "signinconfirmpassword" class ="signinput">
                            <span class = "error"><?=$confirmPasswordErr; ?></span></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type = "submit" name = "signinbtn" value = "Sign In" class = "auth-btn"></td>
                        </tr>
                    </table>
            </form>
                </div>
            </div>
        </div>
    </body>
</html>