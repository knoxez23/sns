<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userCheckId = $_GET['userCheck'];
    $stmnt = "SELECT Fname, Lname, home_address, email, city, state, phone_number FROM users WHERE id = ?";
    $prep_stmnt = $conn->prepare($stmnt);
    $prep_stmnt->bind_param('i', $userCheckId);
    $prep_stmnt->execute();
    if ($result = $prep_stmnt->get_result()) {
        $rowArray = $result->fetch_assoc();
        echo json_encode(['result' => $rowArray]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    $prep_stmnt->close();
    exit();
}
