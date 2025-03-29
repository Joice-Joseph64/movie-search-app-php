<?php
require_once "../config/database.php";
// session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please log in to view your favorite movies.";
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM favorite_movies WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$favorites = [];

while ($row = $result->fetch_assoc()) {
    $favorites[] = $row;
}

header('Content-Type: application/json');
echo json_encode($favorites);
?>
