<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $name = $_GET['name'];

    $stmnt = "SELECT * FROM shoe_sizes WHERE product_name=?";
    $prep_stmt = $conn->prepare($stmnt);
    $prep_stmt->bind_param('s', $name);
    $prep_stmt->execute();
    if ($result = $prep_stmt->get_result()) {
        $arr = array();
        while ($rowArray = $result->fetch_assoc()) {
            array_push($arr, $rowArray);
        }
        echo json_encode(['sizes' => $arr]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    exit();
}
