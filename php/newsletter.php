<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['email']) {
    $email = $_POST['email'];

    $stmnt = "INSERT INTO newsletter(email) VALUES(?)";
    $prep_stmnt = $conn->prepare($stmnt);
    $prep_stmnt->bind_param('s', $email);
    if($prep_stmnt->execute()){
        echo "Success";
    }else{
        echo "Error";
    }
    $prep_stmnt->close();
    exit();
}
