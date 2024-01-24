<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT SUM(paid_amount) AS totals, EXTRACT(MONTH FROM date) AS curmonth FROM transactions GROUP BY EXTRACT(MONTH FROM date)";
    if ($result = $conn->query($sql)) {
        $arr = array();
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row);
        }
        echo json_encode(['transactionsmonthly' => $arr]);
    } else {
        echo json_encode(['error' => "Something went wrong transaction to earnings. Try again later"]);
    }
    exit();
}
