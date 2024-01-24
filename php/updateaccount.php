<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['id'])) {
    $value = testinput($_POST['value']);
    $column = testinput($_POST['column']);
    $id = testinput($_POST['id']);

    $sql = "UPDATE users SET $column = ? WHERE id = ? LIMIT 1;";
    $prep_stmnt = $conn->prepare($sql);
    $prep_stmnt->bind_param('ss', $value, $id);
    if ($prep_stmnt->execute()) {
        echo "Succesful";
    } else echo "Failed";
    $prep_stmnt->close();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['uid'])) {
    $uid = testinput($_GET['uid']);
    $array = array();

    $stmt = "SELECT * FROM users WHERE id = ?;";
    $prep_stumnt = $conn->prepare($stmt);
    $prep_stumnt->bind_param('s', $uid);
    $prep_stumnt->execute();
    if ($result = $prep_stumnt->get_result()) {
        $arr = array();
        while ($rowArray = $result->fetch_assoc()) {
            array_push($arr, $rowArray);
        }
        echo json_encode(['details' => $arr]);
    }
    $prep_stumnt->close();
    exit();
}


function testinput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
