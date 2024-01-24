<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['query']) {

    $search_input = $_GET['query'];
    $search = "%$search_input%";

    $stmnt = "SELECT * FROM transactions WHERE customer_name LIKE ?;";
    $prep_stmnt = $conn->prepare($stmnt);
    $prep_stmnt->bind_param('s', $search);
    $prep_stmnt->execute();
    if ($result = $prep_stmnt->get_result()) {
        $arr = array();
        while ($rowArray = $result->fetch_assoc()) {
            array_push($arr, $rowArray);
        }
        echo json_encode(['transactions' => $arr]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    $prep_stmnt->close();
    exit();
}
