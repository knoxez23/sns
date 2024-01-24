<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']==='GET'){
    $stmnt = "SELECT * FROM customer_remarks WHERE status= 1 ORDER BY RAND() LIMIT 3;";
    if($result = $conn->query($stmnt)){
        $arr = array();
        while($rowArray = $result->fetch_assoc()){
            array_push($arr, $rowArray);
        }
        echo json_encode(['testimonies'=>$arr]);
    }
    else{
        echo json_encode(['error'=> 'Something went wrong. Try again later']);
    }
    exit();
}