<?php
require_once "../config/database.php";
// session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['movie_id'])) {
    $user_id = $_SESSION['user_id'];
    $movie_id = $_POST['movie_id'];

    $deleteQuery = "DELETE FROM favorite_movies WHERE user_id = ? AND movie_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("is", $user_id, $movie_id);
    $stmt->execute();
    
    echo "Movie removed from favorites.";
}
?>
