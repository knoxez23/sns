<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT SUM(amount) AS totals FROM earnings";
    if ($result = $conn->query($sql)) {
        $arr = array();
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row);
        }
        echo json_encode(['allearnings' => $arr]);
    } else {
        echo json_encode(['error' => "Something went wrong. Try again later"]);
    }
    exit();
}
