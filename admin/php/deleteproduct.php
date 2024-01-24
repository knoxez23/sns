<?php
include_once 'dbconn.php';

if (!empty($_POST['dele-name']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['dele-name'];

    $stmt = "SELECT * FROM products WHERE name = ?";
    $prep_stmt = $conn->prepare($stmt);
    $prep_stmt->bind_param('s', $name);
    $prep_stmt->execute();
    if ($result = $prep_stmt->get_result()) {
        $id = $result->fetch_assoc()['id'];
    }
    $prep_stmt->close();

    $query = "DELETE FROM products where id = ?";
    $prep_query = $conn->prepare($query);
    $prep_query->bind_param('i', $id);
    $prep_query->execute();
    $prep_query->close();

    header('location: ../products.php?msg=success');
    exit();
}
