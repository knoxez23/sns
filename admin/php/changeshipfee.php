<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newval = $_POST['newval'];
    $country = $_POST['country'];

    $sql = "UPDATE shipping_fee SET fee = ? WHERE country = ?";
    $prep_sql = $conn->prepare($sql);
    $prep_sql->bind_param('ds', $newval, $country);
    $prep_sql->execute();
    $prep_sql->close();

    header('location: ../discounts.php?msg=success');
    exit();
}
