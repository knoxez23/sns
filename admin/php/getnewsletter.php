<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmnt = "SELECT * FROM newsletter ORDER BY date DESC";
    if ($result = $conn->query($stmnt)) {
        $arr = array();
        while ($rowArray = $result->fetch_assoc()) {
            array_push($arr, $rowArray);
        }
        $totalnewsletter = mysqli_num_rows($result);
        echo json_encode(['newsletters' => $arr, 'number' => $totalnewsletter]);
    } else {
        echo json_encode(['error' => 'Something went wrong during newsletter getting. Try again later']);
    }
    exit();
}
