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

<?php if ($check == 1): ?>
    <h2 class="favorites-title">Your Favorite Movies</h2>
    <div id="favorites" class="favorites-container"></div>
<?php endif; ?>
