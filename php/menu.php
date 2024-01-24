<?php
require "db.php";

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']==='GET'){
    $stmnt = "SELECT name FROM categories WHERE status=1;";
    if($result = $conn->query($stmnt)){
        $arr = array();
        while($name = $result->fetch_assoc()['name']){
            array_push($arr, $name);
        }
        echo json_encode(['categories'=>$arr]);
    }
    else{
        echo json_encode(['error'=> 'Something went wrong. Try again later']);
    }
    exit();
}