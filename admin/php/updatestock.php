<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stock = $_POST['value'];
    $id = $_POST['id'];

    $stmt = "UPDATE products SET stock = ? WHERE id = ?";
    $prep_stmt = $conn->prepare($stmt);
    $prep_stmt->bind_param('ii', $stock, $id);
    $prep_stmt->execute();
    $prep_stmt->close();

    header("location: ../products.php?msg=success");
}
