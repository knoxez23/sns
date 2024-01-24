<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmnt = "SELECT * FROM products WHERE (prevprice-price)>70;";
    if ($result = $conn->query($stmnt)) {
        $arr = array();
        while ($rowArray = $result->fetch_assoc()) {
            array_push($arr, $rowArray);
        }
        $totalpros = mysqli_num_rows($result);
        echo json_encode(['products' => $arr, 'totalpros' => $totalpros]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    exit();
}
