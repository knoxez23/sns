<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['coupname'];
    $code = $_POST['coupcode'];
    $amount = $_POST['coupamount'];
    $criteria = $_POST['user-criteria']; 

    $sql = "INSERT INTO coupon(name, code, amount, criteria) VALUES(?, ?, ?, ?)";
    $prep_sql = $conn->prepare($sql);
    $prep_sql->bind_param('ssdi', $name, $code, $amount, $criteria);
    $prep_sql->execute();
    $prep_sql->close();

    header('location: ../discounts.php?msg=success');
    exit();
}
