<?php
require_once "../config/database.php";
// session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['movie_id'])) {
    $user_id = $_SESSION['user_id'];
    $movie_id = $_POST['movie_id'];
    $movie_title = $_POST['movie_title'];
    $poster_url = $_POST['poster_url'];

    $checkQuery = "SELECT * FROM favorite_movies WHERE user_id = ? AND movie_id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("is", $user_id, $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $insertQuery = "INSERT INTO favorite_movies (user_id, movie_title, movie_id, poster_url) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("isss", $user_id, $movie_title, $movie_id, $poster_url);
        $stmt->execute();
        echo "Movie added to favorites!";
    } else {
        echo "Movie is already in your favorites.";
    }
}
?>
