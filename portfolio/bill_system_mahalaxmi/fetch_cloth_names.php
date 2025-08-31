<?php
include 'db.php';

$term = $_GET['term'] ?? '';
$term = $conn->real_escape_string($term);

$query = "SELECT cloth_name FROM cloths WHERE cloth_name LIKE '%$term%' LIMIT 10";
$result = $conn->query($query);

$suggestions = [];
while ($row = $result->fetch_assoc()) {
    $suggestions[] = $row['cloth_name'];
}

echo json_encode($suggestions);
?>
