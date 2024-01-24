<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['catid'])) {
    $stmnt = "SELECT name FROM categories WHERE id = ?;";
    $prep_stmnt = $conn->prepare($stmnt);
    $catid =  $_GET['catid'];
    $prep_stmnt->bind_param('i', $catid);
    $prep_stmnt->execute();
    if ($result = $prep_stmnt->get_result()) {
        echo json_encode(['name' => $result->fetch_assoc()['name']]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    $prep_stmnt->close();
    exit();
}
