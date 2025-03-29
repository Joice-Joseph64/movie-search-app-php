<?php
$apiKey = "your-omdb-api-key";
$query = $_GET['query'];

$apiUrl = "http://www.omdbapi.com/?apikey=$apiKey&s=" . urlencode($query);
$response = file_get_contents($apiUrl);

echo $response;
?>
