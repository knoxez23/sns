<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmnt = "SELECT SUM(quantity) as qty FROM transactions";
    if ($result = $conn->query($stmnt)) {
        $qty = $result->fetch_assoc()['qty'];            
        echo json_encode(['prosold' => $qty]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    exit();
}
