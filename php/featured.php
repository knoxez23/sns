<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']==='GET'){
    $stmnt = "SELECT * FROM products WHERE status= 1 ORDER BY rand() LIMIT 10;";
    if($result = $conn->query($stmnt)){
        $arr = array();
        while($rowArray = $result->fetch_assoc()){
            array_push($arr, $rowArray);
        }
        echo json_encode(['featured'=>$arr]);
    }
    else{
        echo json_encode(['error'=> 'Something went wrong. Try again later']);
    }
    exit();
}