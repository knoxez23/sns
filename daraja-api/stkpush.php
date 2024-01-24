<?php
require 'accessToken.php';
require '../php/db.php';

date_default_timezone_set('Africa/Nairobi');

$payAmount = 0;
$partyA = $_POST['number'];
$prodId = $_POST['prodId'];
$userId = $_POST['userId'];
$qty = $_POST['qty'];


if(is_array($prodId)){
  for($i = 0; $i < count($prodId); $i++){
    $stmnt = "SELECT * from products WHERE id = ?";
    $prep_stmnt = $conn->prepare($stmnt);
    $prep_stmnt->bind_param('s', $prodId[$i]);
    $prep_stmnt->execute();
    if($result = $prep_stmnt->get_result()){
      $rowArray = $result->fetch_assoc()['price'];
      $prototal = $rowArray * $qty[$i];
      global $payAmount;
      $payAmount = $payAmount + $prototal;
    }
    $prep_stmnt->close();
  }
}else{
  $stmnt = "SELECT * from products WHERE id = ?";
  $prep_stmnt = $conn->prepare($stmnt);
  $prep_stmnt->bind_param('s', $prodId);
  $prep_stmnt->execute();
  if($result = $prep_stmnt->get_result()){
    $rowArray = $result->fetch_assoc()['price'];
    $prototal = $rowArray * $qty;
    global $payAmount;
    $payAmount = $payAmount + $prototal;
  }
  $prep_stmnt->close();
}

$qtyEncodedData = urlencode(json_encode($qty));
$prodIdEncodedData = urlencode(json_encode($prodId));

$processrequestURL = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackURL = "https://8dc5-102-215-32-244.ngrok-free.app/plenser/daraja-api/callback.php?prodId=$prodIdEncodedData&userId=$userId&qty=$qtyEncodedData";

$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$businessShortCode = '174379';
$timestamp = date('YmdHis');

$password = base64_encode($businessShortCode . $passkey . $timestamp);
$accountReference = 'PLENSER_SPARES';
$transactionDesc = 'STKPush Test';
$stkpushheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];

$curl_post_data = array(
  'BusinessShortCode' => $businessShortCode,
  'Password' => $password,
  'Timestamp' => $timestamp,
  'TransactionType' => 'CustomerPayBillOnline',
  'Amount' => $payAmount,
  'PartyA' => $partyA,
  'PartyB' => $businessShortCode,
  'PhoneNumber' => $partyA,
  'CallBackURL' => $callbackURL,
  'AccountReference' => $accountReference,
  'TransactionDesc' => $transactionDesc
);
$data_string = json_encode($curl_post_data);


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $processrequestURL);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$data = json_decode(curl_exec($curl));
curl_close($curl);

$checkoutRequestID= $data->CheckoutRequestID;
$responseCode = $data->ResponseCode;

echo json_encode(['checkoutRequestID' => $checkoutRequestID, 'responseCode' => $responseCode]);
