<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmnt = "SELECT * FROM inbusiness_transactions ORDER BY date DESC";
    if ($result = $conn->query($stmnt)) {
        $arr = array();
        while ($rowArray = $result->fetch_assoc()) {
            array_push($arr, $rowArray);
        }
        $totalinbusiness = mysqli_num_rows($result);
        echo json_encode(['allinbusiness' => $arr, 'totalinbusiness' => $totalinbusiness]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    exit();
}
