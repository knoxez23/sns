<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $name = $_GET['name'];

    $sql = "SELECT * FROM products WHERE name LIKE ? OR brand LIKE ? OR fulldesc LIKE ? OR shortdesc LIKE ?;";
    $prep_sql = $conn->prepare($sql);
    $prep_sql->bind_param('ssss', $name, $name, $name, $name);
    $prep_sql->execute();
    if ($result = $prep_sql->get_result()) {
        $arr = array();
        while ($rowArray = $result->fetch_assoc()) {
            array_push($arr, $rowArray);
        }
        echo json_encode(['product' => $arr]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
}
