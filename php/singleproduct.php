<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']==='GET' && isset($_GET['prid'])){
    $stmnt = "SELECT * FROM products WHERE id = ?";
    $prep_stmnt = $conn->prepare($stmnt);
    $id =  $_GET['prid'];
    $prep_stmnt->bind_param('s', $id);
    $prep_stmnt->execute();
    if($result = $prep_stmnt->get_result()){
        $arr = array();
        while($rowArray = $result->fetch_assoc()){
            array_push($arr, $rowArray);
        }
        echo json_encode(['product'=>$arr]);
    }
    else{
        echo json_encode(['error'=> 'Something went wrong. Try again later']);
    }
    $prep_stmnt->close();
    exit();
}