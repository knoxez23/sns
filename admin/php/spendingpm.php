<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT SUM(amount) AS totals, EXTRACT(MONTH FROM date) AS curmonth FROM inbusiness_transactions GROUP BY EXTRACT(MONTH FROM date)";
    if ($result = $conn->query($sql)) {
        $arr = array();
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row);
        }
        echo json_encode(['allspendings' => $arr]);
    } else {
        echo json_encode(['error' => "Something went wrong. Try again later"]);
    }
    exit();
}
