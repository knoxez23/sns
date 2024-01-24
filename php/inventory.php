<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']==='GET' && isset($_GET['id'])){
    $stmnt = "SELECT stock FROM inventory WHERE product_id = ?;";
    $prep_stmnt = $conn->prepare($stmnt);
    $id =  $_GET['id'];
    $prep_stmnt->bind_param('i', $id);
    $prep_stmnt->execute();
    if($result = $prep_stmnt->get_result()){
        // $arr = array();
        // while($rowArray = $result->fetch_assoc()){
            // array_push($arr, $result->fetch_assoc());
        // }
        // $totalpros = mysqli_num_rows($result);
        echo json_encode(['stock' => $result->fetch_assoc()['stock']]);
    }
    else{
        echo json_encode(['error'=> 'Something went wrong. Try again later']);
    }
    $prep_stmnt->close();
    exit();
}