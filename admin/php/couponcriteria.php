<?php
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $arr = array();
    $id = $_GET['id'];
    $stmt = "SELECT * FROM coupon_criteria WHERE id = $id";
    $prep_stmt = $conn->prepare($stmt);
    $prep_stmt->execute();
    if ($result = $prep_stmt->get_result()) {
        while ($criteriarow = $result->fetch_assoc()) {
            array_push($arr, $criteriarow);
        }
        echo json_encode(['criteria' => $arr]);
    }
}
