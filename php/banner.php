<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']==='GET'){
    $stmnt = "SELECT * FROM banner WHERE id=1;";
    if($result = $conn->query($stmnt)){
        $arr = array();
        while($rowArray = $result->fetch_assoc()['name']){
            array_push($arr, $rowArray);
        }
        echo json_encode(['banners'=>$arr]);
    }
    else{
        echo json_encode(['error'=> 'Something went wrong. Try again later']);
    }
    exit();
}