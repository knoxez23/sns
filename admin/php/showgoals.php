<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM goals";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo json_encode(['goals' => $row]);
    exit();
}
