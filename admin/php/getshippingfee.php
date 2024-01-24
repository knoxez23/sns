<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $country = $_GET['country'];

    $sql = "SELECT * FROM shipping_fee WHERE country = ?";
    $prep_sql = $conn->prepare($sql);
    $prep_sql->bind_param('s', $country);
    $prep_sql->execute();
    if ($result = $prep_sql->get_result()) {
        $row = $result->fetch_assoc();
        echo json_encode(['shippingdata' => $row]);
    }
    $prep_sql->close();

    exit();
}
