<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $sql = "DELETE FROM coupon WHERE name =? LIMIT 1";
    $prep_sql = $conn->prepare($sql);
    $prep_sql->bind_param('s', $name);
    $prep_sql->execute();
    $prep_sql->close();

    header('location: ../discounts.php?msg=success');
    exit();
}
