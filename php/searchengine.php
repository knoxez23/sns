<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['search']) {

    $search_input = testinput($_GET['search']);
    $search = "%$search_input%";

    $stmnt = "SELECT * FROM products WHERE name LIKE ? OR brand LIKE ? OR fulldesc LIKE ? OR shortdesc LIKE ?;";
    $prep_stmnt = $conn->prepare($stmnt);
    $prep_stmnt->bind_param('ssss', $search, $search, $search, $search);
    $prep_stmnt->execute();
    if ($result = $prep_stmnt->get_result()) {
        $arr = array();
        while ($rowArray = $result->fetch_assoc()) {
            array_push($arr, $rowArray);
        }
        $totalpros = mysqli_num_rows($result);
        echo json_encode(['products' => $arr, 'totalpros' => $totalpros]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    $prep_stmnt->close();
    exit();
}

function testinput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
