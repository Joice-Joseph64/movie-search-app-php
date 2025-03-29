<?php

require_once '../config/database.php';

// var_dump($_SESSION); 


session_destroy();
header('location:../home/home.php');

?>