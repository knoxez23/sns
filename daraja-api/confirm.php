<?php
require '../php/db.php';

header('Access-Control-Allow-Origin: *');

$totals = 3;

if (isset($_GET['checkoutRequestID']) && isset($_GET['responseCode']) && isset($_GET['prodId']) && isset($_GET['qty']) && isset($_GET['userId'])) {
    $checkoutRequestID = $_GET['checkoutRequestID'];
    $responseCode = $_GET['responseCode'];
    $productId = $_GET['prodId'];
    $productQty = $_GET['qty'];
    $userId = $_GET['userId'];
    $shipping_fee = 0;
    $payAmount = 0;

    $productId = explode(',', $productId);
    $productQty = explode(',', $productQty);

    if (is_array($productId)) {
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
    } else {
        $stmnt = "SELECT * from products WHERE id = ?";
        $prep_stmnt = $conn->prepare($stmnt);
        $prep_stmnt->bind_param('s', $productId);
        $prep_stmnt->execute();
        if ($result = $prep_stmnt->get_result()) {
            $rowArray = $result->fetch_assoc()['price'];
            $prototal = $rowArray * $productQty;
            global $totals;
            $totals = $totals + $prototal;
        }
        $prep_stmnt->close();
    }

    $txnStmnt = "SELECT * FROM transactions WHERE customer_id = ? AND checkOutRequestId = ?;";
    $prep_txnStmnt = $conn->prepare($txnStmnt);
    $prep_txnStmnt->bind_param('is', $userId, $checkoutRequestID);
    $prep_txnStmnt->execute();
    if ($txnResult = $prep_txnStmnt->get_result()) {
        $payAmount = $txnResult->fetch_assoc()['paid_amount'];
        $resultCode = $txnResult->fetch_assoc()['responseCode'];

        if($resultCode == 0){
            if ($payAmount = $totals) {
                if (is_array($productId)) {
                    for ($i = 0; $i < count($productId); $i++) {
                        $orderStmnt = "INSERT INTO orders(customer_id, product_id, quantity, shipping_fee, total_paid) VALUES(?, ?, ?, ?, ?)";
                        $prep_orderStmnt = $conn->prepare($orderStmnt);
                        $prep_orderStmnt->bind_param('siidd', $userId, $productId[$i], $productQty[$i], $shipping_fee, $payAmount);
                        $prep_orderStmnt->execute();                        
                        
                        $prep_orderStmnt->close();
                    }
                } else {
                    $orderStmnt = "INSERT INTO orders(customer_id, product_id, quantity, shipping_fee, total_paid) VALUES(?, ?, ?, ?, ?)";
                    $prep_orderStmnt = $conn->prepare($orderStmnt);
                    $prep_orderStmnt->bind_param('siidd', $userId, $productId, $productQty, $shipping_fee, $payAmount);
                    $prep_orderStmnt->execute();
    
                    $prep_orderStmnt->close();
                }

                header("location: ../checkout.php?msg=paid");
                exit();
            } else {
                header("location: ../checkout.php?msg=invalidAmount");
                exit();
            }
        } else if($resultCode == 1){
            header("location: ../checkout.php?msg=insufficientBalance");
            exit();
        } else if($resultCode == 1037){
            header("location: ../checkout.php?msg=timeout");
            exit();
        } else if($resultCode == 1032){
            header("location: ../checkout.php?msg=cancelled");
            exit();
        } else {
            header("location: ../checkout.php?msg=failed");
            exit();
        }
    } else {
        header("location: ../checkout.php?msg=invalidTransaction");
        exit();
    }

    $prep_txnStmnt->close();

  // $userStmt = "SELECT * FROM users WHERE id = ?";
  // $prep_userStmt = $conn->prepare($userStmt);
  // $prep_userStmt->bind_param('s', $userCheckId);
  // $prep_userStmt->execute();
  // if ($userResult = $prep_userStmt->get_result()) {
  //     $userCountry = $userResult->fetch_assoc()['country'];
  // }
  // $prep_userStmt->close();


  // $countryStmt = "SELECT * FROM shipping_fee WHERE country = ?";
  // $prep_countryStmt = $conn->prepare($countryStmt);
  // $prep_countryStmt->bind_param('s', $userCountry);
  // $prep_countryStmt->execute();
  // if ($countryResult = $prep_countryStmt->get_result()) {
  //     $shipping_fee = $countryResult->fetch_assoc()['fee'];
  // }
  // $prep_countryStmt->close();

  // $totals = $totals + $shipping_fee;

   
}
