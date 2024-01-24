<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $uId = $_GET['uid'];
    $stmnt = "SELECT * FROM orders WHERE customer_id = ?;";
    $prep_stmnt = $conn->prepare($stmnt);
    $prep_stmnt->bind_param('i', $uId);
    $prep_stmnt->execute();
    if ($result = $prep_stmnt->get_result()) {
        $arr = array();
        while ($rowArray = $result->fetch_assoc()) {
            array_push($arr, $rowArray);
        }
        echo json_encode(['orders' => $arr]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    $prep_stmnt->close();
    exit();
}
