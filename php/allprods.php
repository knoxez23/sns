<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']==='GET'){
    $stmnt = "SELECT * FROM products WHERE status=1";
    if($result = $conn->query($stmnt)){
        $arr = array();
        while($rowArray = $result->fetch_assoc()){
            array_push($arr, $rowArray);
        }
        $totalAllpros = mysqli_num_rows($result);
        echo json_encode(['allproducts'=>$arr, 'alltotalpros'=>$totalAllpros]);
    }
    else{
        echo json_encode(['error'=> 'Something went wrong. Try again later']);
    }
    exit();
}