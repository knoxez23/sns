<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['shoename'];

    echo $name;

    for ($size = 35; $size <= 49; $size++) {
        if (!empty($_POST["$size"])) {
            $enterSizeStmt = 'UPDATE shoe_sizes SET size' . $size . ' = ' . $_POST["$size"] . ' WHERE product_name= ?';
            $prepstmt = $conn->prepare($enterSizeStmt);
            $prepstmt->bind_param('s', $name);
            $prepstmt->execute();
            $prepstmt->close();
        }
    }


    header('location: ../products.php?msg=success');
    exit();
}
