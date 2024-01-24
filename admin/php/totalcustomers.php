<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmnt = "SELECT * FROM transactions GROUP BY created";
    if ($result = $conn->query($stmnt)) {
        $number = mysqli_num_rows($result);
        echo json_encode(['number' => $number]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    exit();
}
