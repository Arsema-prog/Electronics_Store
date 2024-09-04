<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$conn = new mysqli("localhost", "root", "", "electronics_store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$base_url = 'http://localhost/php/electronics/uploades/';

$res = $conn->query("SELECT product_name, image FROM electronics_store");

$products = [];

if ($res->num_rows > 0) {
    while ($rowdata = $res->fetch_assoc()) {
        $rowdata['image'] = $base_url . basename($rowdata['image']);
        $products[] = $rowdata;
    }
}

echo json_encode($products);

$conn->close();
?>
