<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['orderid'];

    $stmnt = "UPDATE orders SET status = 1, delivery_date = CURRENT_TIMESTAMP WHERE id = ?";
    $prep_stmnt = $conn->prepare($stmnt);
    $prep_stmnt->bind_param('i', $orderId);
    $prep_stmnt->execute();
    $prep_stmnt->close();

    exit();
}
