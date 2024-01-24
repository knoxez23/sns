<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['prodid'])) {
    $stmnt = "SELECT * FROM products WHERE id=?;";
    $prep_stmnt = $conn->prepare($stmnt);
    $prodID =  $_GET['prodid'];
    $prep_stmnt->bind_param('i', $prodID);
    $prep_stmnt->execute();
    if ($result = $prep_stmnt->get_result()) {
        $arr = array();
        while ($rowArray = $result->fetch_assoc()) {
            array_push($arr, $rowArray);
        }
        echo json_encode(['product' => $arr]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    $prep_stmnt->close();
    exit();
}
