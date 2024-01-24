<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['prodid'];
    $status = $_POST['status'];

    if ($status == 0) {
        $stat = 1;
    } elseif ($status == 1) {
        $stat = 0;
    }
    $sql = "UPDATE products SET status = $stat WHERE id =?";
    $prep_sql = $conn->prepare($sql);
    $prep_sql->bind_param('i', $id);
    $prep_sql->execute();
    $prep_sql->close();

    header('location: ../../products.php?msg=success');
    exit();
}
