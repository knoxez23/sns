<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $company = $_POST['company'];
    $purpose = $_POST['purpose'];

    $sql = "INSERT INTO inbusiness_transactions(amount, company, purpose) VALUES(?, ?, ?)";
    $prep_sql = $conn->prepare($sql);
    $prep_sql->bind_param('dss', $amount, $company, $purpose);
    $prep_sql->execute();
    $prep_sql->close();

    header('location: ../transactions.php?msg=success');
    exit();
}
