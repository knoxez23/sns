<?php
require '../php/db.php';

header("Content-Type: application/json");

$stkCallbackResponse = file_get_contents('php://input');

$data = json_decode($stkCallbackResponse);

$amount = 0;
$transactionId = "";
$transactionDate = "";
$userPhoneNumber = "";
$source = "M-PESA";
$userId = $_GET['userId'];
$URLprodId = $_GET['prodId'];
$URLqty = $_GET['qty'];

$prodId = urldecode($URLprodId);
$qty= urldecode($URLqty);

$prodId = json_decode($prodId);
$qty = json_decode($qty);


$merchantRequestID = $data->Body->stkCallback->MerchantRequestID;
$checkoutRequestID = $data->Body->stkCallback->CheckoutRequestID;
$resultCode = $data->Body->stkCallback->ResultCode;
$resultDesc = $data->Body->stkCallback->ResultDesc;
$amount = $data->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$transactionId = $data->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$transactionDate = $data->Body->stkCallback->CallbackMetadata->Item[3]->Value;
$userPhoneNumber = $data->Body->stkCallback->CallbackMetadata->Item[4]->Value;

$created = date('Y-m-d H:i:s', strtotime($transactionDate));


if ($resultCode == 0) {
    $paymentStatus = "Paid";
    if(is_array($prodId)){
        for($i = 0; $i < count($prodId); $i++){
            $stmt = "INSERT INTO transactions(customer_id, product_id, checkOutRequestId, responseCode, quantity, paid_amount, txn_id, phone_number, payment_status, source, created) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
            $prep_stmt = $conn->prepare($stmt);
            $prep_stmt->bind_param('sisiiisiiss', $userId, $prodId[$i], $checkoutRequestID, $resultCode, $qty[$i], $amount, $transactionId, $userPhoneNumber, $paymentStatus, $source, $created);
            $prep_stmt->execute();
            $prep_stmt->close();
        }
    } else{
        $stmt = "INSERT INTO transactions(customer_id, product_id, checkOutRequestId, responseCode, quantity, paid_amount, txn_id, phone_number, payment_status, source, created) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $prep_stmt = $conn->prepare($stmt);
        $prep_stmt->bind_param('sisiiisiiss', $userId, $prodId, $checkoutRequestID, $resultCode, $qty, $amount, $transactionId, $userPhoneNumber, $paymentStatus, $source, $created);
        $prep_stmt->execute();
        $prep_stmt->close();
    }    
}else{
    $paymentStatus = "Failed";
    if(is_array($prodId)){
        for($i = 0; $i < count($prodId); $i++){
            $stmt = "INSERT INTO transactions(customer_id, product_id, checkOutRequestId, responseCode, quantity, paid_amount, txn_id, phone_number, payment_status, source, created) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
            $prep_stmt = $conn->prepare($stmt);
            $prep_stmt->bind_param('sisiiisiiss', $userId, $prodId[$i], $checkoutRequestID, $resultCode, $qty[$i], $amount, $transactionId, $userPhoneNumber, $paymentStatus, $source, $created);
            $prep_stmt->execute();
            $prep_stmt->close();
        }
    } else{
        $stmt = "INSERT INTO transactions(customer_id, product_id, checkOutRequestId, responseCode, quantity, paid_amount, txn_id, phone_number, payment_status, source, created) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $prep_stmt = $conn->prepare($stmt);
        $prep_stmt->bind_param('sisiiisiiss', $userId, $prodId, $checkoutRequestID, $resultCode, $qty, $amount, $transactionId, $userPhoneNumber, $paymentStatus, $source, $created);
        $prep_stmt->execute();
        $prep_stmt->close();
    }
}