<?php
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $income = $_POST['income'];
    $expenses = $_POST['expenses'];

    $sql = "UPDATE goals SET earning_goal = ? , spending_goal = ? WHERE id = 1";
    $prep_sql = $conn->prepare($sql);
    $prep_sql->bind_param('dd', $income, $expenses);
    $prep_sql->execute();
    $prep_sql->close();

    header('location: ../dashboard.php?msg=success');
    exit();
}
