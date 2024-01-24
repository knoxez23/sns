<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmnt = "SELECT SUM(amount) AS totals FROM inbusiness_transactions";
    if ($result = $conn->query($stmnt)) {
        $arr = array();
        while ($rowArray = $result->fetch_assoc()) {
            array_push($arr, $rowArray);
        }
        echo json_encode(['allexpenses' => $arr]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    exit();
}
