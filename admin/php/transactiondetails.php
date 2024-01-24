<?php
include_once 'dbconn.php';

$arr = array();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $prodId = $_GET['prodid'];
    $userId = $_GET['userid'];
    $stmnt = "SELECT * FROM products WHERE id = $prodId";
    if ($result = $conn->query($stmnt)) {
        while ($prorow = $result->fetch_assoc()) {
            array_push($arr, $prorow);
        }
    }

    $cust = "SELECT * FROM users WHERE id = $userId";
    if ($answer = $conn->query($cust)) {
        while ($userrow = $answer->fetch_assoc()) {
            array_push($arr, $userrow);
        }
    }

    echo json_encode(['transdets' => $arr]);
    exit();
}
