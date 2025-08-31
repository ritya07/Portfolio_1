<?php
include 'db.php';

$cloth_name = $_POST['cloth_name'];
$price_per_meter = $_POST['price_per_meter'];
$action = $_POST['action'];

if ($action == "add") {
    $conn->query("INSERT INTO cloths (cloth_name, price_per_meter) VALUES ('$cloth_name', $price_per_meter)");
} elseif ($action == "update") {
    $conn->query("UPDATE cloths SET price_per_meter=$price_per_meter WHERE cloth_name='$cloth_name'");
} elseif ($action == "delete") {
    $conn->query("DELETE FROM cloths WHERE cloth_name='$cloth_name'");
}

header("Location: admin.html");
?>
