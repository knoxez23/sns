<?php
include_once 'dbconn.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $arr = array();
    $stmnt = "SELECT * FROM orders WHERE status = 1 ORDER BY date DESC";
    if ($result = $conn->query($stmnt)) {
        while ($orderrow = $result->fetch_assoc()) {
            array_push($arr, $orderrow);
        }
        $totalclosed = mysqli_num_rows($result);
        echo json_encode(['closedorders' => $arr, 'totalclosed' => $totalclosed]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    exit();
}
