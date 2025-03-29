<?php
require_once "../config/database.php";
require_once "logincode.php";

if(!empty($_SESSION['user_id']))
{
    header('Location: home.php');
}
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type = "text/css" href = "../css/style.css">
    </head>
    <body>
        <form action ="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method ="post">
            <div class = "container">
                <div class = "header">
                    <div class = "logo">Movie Search
                        <div class = "loginbtn">
                            <ul class = "ul1">
                                <li class = "li1"><a href = "../home/home.php" class = "homelink">Home</a></li>
                                <li class = "li1"><a href = "adminlogin.php" class = "homelink">Admin Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class = "gallery">
                    <div class = "logindiv">
                        <h1 class="login-title" style ="">Login Page</h1>
                        <span class = "error"><?php echo $messageLError;?></span>
                        <table class = "signintbl">
                            <tr>
                                <td><label>Email :</label></td>
                                <td><input type = "textfield" name = "loginemail" class ="signinput">
                                <span class = "error"><?php echo $emailLErr;?><span></td>
                            </tr>
                            <tr>
                                <td><label>Password :</label></td>
                                <td><input type = "password" name = "loginpassword" class ="signinput">
                                <span class = "error"><?php echo $passwordLErr;?><span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type = "submit" name = "loginsubmit" value = "Login" class="auth-btn"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>