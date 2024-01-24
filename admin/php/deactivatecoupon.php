<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    if($status == 1){
        $stat = 0;
    }else{
        $stat = 1;
    }

    $sql = "UPDATE coupon SET status = ? WHERE id = ?";
    $prep_sql = $conn->prepare($sql);
    $prep_sql->bind_param('ii', $stat, $id);
    $prep_sql->execute();
    $prep_sql->close();

    header('location: ../discounts.php?msg=success');
    exit();
}
