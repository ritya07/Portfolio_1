<?php
include 'db.php';

$cloth_name = $_GET['cloth_name'];
$result = $conn->query("SELECT price_per_meter FROM cloths WHERE cloth_name='$cloth_name'");
$data = $result->fetch_assoc();

echo json_encode($data);
?>
