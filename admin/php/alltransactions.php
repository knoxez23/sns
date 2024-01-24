<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmnt = "SELECT * FROM transactions ORDER BY created DESC";
    if ($result = $conn->query($stmnt)) {
        $arr = array();
        while ($rowArray = $result->fetch_assoc()) {
            array_push($arr, $rowArray);
        }
        $totaltransactions = mysqli_num_rows($result);
        echo json_encode(['alltransactions' => $arr, 'totaltransactions' => $totaltransactions]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    exit();
}
