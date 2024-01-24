<?php
require '../vendor/autoload.php';
require 'db.php';

header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');


$totals = 0;
$amount = 0;
if (isset($_GET['prodId']) && isset($_GET['prodQty']) && isset($_GET['userCheck'])) {
    $productId = $_GET['prodId'];
    $productQty = $_GET['prodQty'];
    $userCheckId = testinput($_GET['userCheck']);

    for ($i = 0; $i < count($productId); $i++) {
        $stmnt = "SELECT * from products WHERE id = ?";
        $prep_stmnt = $conn->prepare($stmnt);
        $prep_stmnt->bind_param('s', $productId[$i]);
        $prep_stmnt->execute();
        if ($result = $prep_stmnt->get_result()) {
            $rowArray = $result->fetch_assoc()['price'];
            $prototal = $rowArray * $productQty[$i];
            global $totals;
            $totals = $totals + $prototal;
        }
        $prep_stmnt->close();
    }


    $userStmt = "SELECT * FROM users WHERE id = ?";
    $prep_userStmt = $conn->prepare($userStmt);
    $prep_userStmt->bind_param('s', $userCheckId);
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


    $totals = $totals + $shipping_fee;
    global $amount;
    $amount = $totals * 100;


    $stripe = new \Stripe\StripeClient("sk_test_51Lw4QGAHySIF1KA26BDtCzX8Cv7ZSvKYYV9tHcNy73FfoY0OhM6PcLz3V6Yrslmc5rOIAW5R3ieg1whH6iHxUTFZ00rud5y4I4");
    $paymentIntent = $stripe->paymentIntents->create([
        'amount' => $amount,
        'currency' => 'usd',
        'payment_method_types' => ['card'],
        'description' => 'Payment Collected on My behalf'
    ]);

    echo json_encode(['client_secret' => $paymentIntent->client_secret]);

    exit();
}



function testinput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
