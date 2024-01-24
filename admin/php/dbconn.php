<?php

$server_name = "localhost";
$username = "snshopco_lexxx";
$passwd = "ZIJpB@z)7^zG";
$db_name = "snshopco_snshop";


$conn = new mysqli($server_name, $username, $passwd, $db_name);
if ($conn->connect_errno) {
    echo json_encode(['error' => $conn->connect_error]);
    exit();
}
