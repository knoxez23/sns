<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']==='GET' && isset($_GET['category'])){
    $stmnt = "SELECT * FROM products WHERE status=1 AND category_id = (SELECT id from categories WHERE name = ?);";
    $prep_stmnt = $conn->prepare($stmnt);
    $category =  $_GET['category'];
    $prep_stmnt->bind_param('s', $category);
    $prep_stmnt->execute();
    if($result = $prep_stmnt->get_result()){
        $arr = array();
        while($rowArray = $result->fetch_assoc()){
            array_push($arr, $rowArray);
        }
        $totalpros = mysqli_num_rows($result);
        echo json_encode(['products'=>$arr, 'totalpros'=>$totalpros]);
    }
    else{
        echo json_encode(['error'=> 'Something went wrong. Try again later']);
    }
    $prep_stmnt->close();
    exit();
}