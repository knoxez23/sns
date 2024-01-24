<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if (isset($_GET['userCheck'])) {
    $userId = testinput($_GET['userCheck']);

    $userStmt = "SELECT * FROM users WHERE id = ?";
    $prep_userStmt = $conn->prepare($userStmt);
    $prep_userStmt->bind_param('s', $userId);
    $prep_userStmt->execute();
    if ($userResult = $prep_userStmt->get_result()) {
        $userCountry = $userResult->fetch_assoc()['country'];
    }
    $prep_userStmt->close();



    $countryStmt = "SELECT * FROM shipping_fee WHERE country = ?";
    $prep_countryStmt = $conn->prepare($countryStmt);
    $prep_countryStmt->bind_param('s', $userCountry);
    $prep_countryStmt->execute();
    if ($countryResult = $prep_countryStmt->get_result()) {
        $shipping_fee = $countryResult->fetch_assoc()['fee'];
    }
    $prep_countryStmt->close();

    if (!is_null($shipping_fee)) {
        echo json_encode(['fee' => $shipping_fee]);
    }
}


function testinput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
