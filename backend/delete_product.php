<?php
session_start();

if (!isset($_SESSION["adminpass"])) {
    header("Location: admin.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $conn = new mysqli("localhost", "root", "", "electronics_store");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("DELETE FROM electronics_store WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: productlist.php?success=1");
    } else {
        header("Location: productlist.php?error=1");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: productlist.php");
    exit();
}
?>
