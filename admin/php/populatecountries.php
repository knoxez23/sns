<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $countries = $_POST['countries'];

    foreach($countries as $value) {
        $stmt = "INSERT INTO shipping_fee(country) VALUES(?)";
        $prep_stmt = $conn->prepare($stmt);
        $prep_stmt->bind_param("s", $value);
        if(!$prep_stmt->execute()){
            echo json_encode(['error' => $prep_stmt->error]);
            exit();
        }else{
            $prep_stmt->close();
            echo json_encode(['success' => 'Shipping fees added successfully']);
            exit();
        }
    }
}