<?php
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $earnings = $_POST['earnings'];
    $month = $_POST['month'];

    $sql = "UPDATE earnings SET amount = $earnings WHERE month = '$month'";
    if ($conn->query($sql)){
        echo json_encode(['success' => "Earnings updated successfully"]);
    } else {
        echo json_encode(['error' => "Something went wrong. Try again later"]);
    }
}