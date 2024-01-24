<?php

require 'db.php';

header('Access-Control-Allow-Origin: *');


$totals = 0;
if (isset($_GET['status']) && isset($_GET['amount']) && isset($_GET['prividia']) && isset($_GET['quavidia']) && isset($_GET['uchekidia']) && isset($_GET['prodSize']) && isset($_GET['currency'])) {

    $payStatus = $_GET['status'];
    $payAmount = $_GET['amount'];
    $payAmount = $payAmount / 100;
    $productId = $_GET['prividia'];
    $productQty = $_GET['quavidia'];
    $productSize = $_GET['prodSize'];
    $userCheckId = $_GET['uchekidia'];
    $txnId = $_GET['txnid'];
    $cardHolder = $_GET['cardholder'];
    $currency = $_GET['currency'];

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

    if ($payStatus === 'succeeded' && $payAmount = $totals) {
        if (is_array($productId)) {
            for ($i = 0; $i < count($productId); $i++) {
                $orderStmnt = "INSERT INTO orders(customer_id, product_id, quantity, size, shipping_fee, total_paid) VALUES(?, ?, ?, ?, ?, ?)";
                $prep_orderStmnt = $conn->prepare($orderStmnt);
                $prep_orderStmnt->bind_param('issidd', $userCheckId, $productId[$i], $productQty[$i], $productSize[$i], $shipping_fee, $totals);
                $prep_orderStmnt->execute();
                $prep_orderStmnt->close();

                $txnStmnt = "INSERT INTO transactions(customer_id, customer_name, product_id, quantity, paid_amount, paid_amount_currency, txn_id, payment_status) VALUES(?, ?, ?, ?, ?, ?)";
                $prep_txnStmnt = $conn->prepare($txnStmnt);
                $prep_txnStmnt->bind_param('isiidsss', $userCheckId, $cardHolder, $productId[$i], $productQty[$i], $payAmount, $currency, $txnId, $payStatus);
                $prep_txnStmnt->execute();
                $prep_txnStmnt->close();
            }
        } else {
            $orderStmnt = "INSERT INTO orders(customer_id, product_id, quantity, size, shipping_fee, total_paid) VALUES(?, ?, ?, ?, ?, ?)";
            $prep_orderStmnt = $conn->prepare($orderStmnt);
            $prep_orderStmnt->bind_param('issidd', $userCheckId, $productId, $productQty, $productSize, $shipping_fee, $totals);
            $prep_orderStmnt->execute();
            $prep_orderStmnt->close();

            $txnStmnt = "INSERT INTO transactions(customer_id, customer_name, product_id, quantity, paid_amount, paid_amount_currency, txn_id, payment_status) VALUES(?, ?, ?, ?, ?, ?)";
            $prep_txnStmnt = $conn->prepare($txnStmnt);
            $prep_txnStmnt->bind_param('isiidsss', $userCheckId, $cardHolder, $productId, $productQty, $payAmount, $currency, $txnId, $payStatus);
            $prep_txnStmnt->execute();
            $prep_txnStmnt->close();
        }

        header('location: ../html/thankyou.php?txnid=' . $txnId . '&check=' . $userCheckId . '&cardholder=' . $cardHolder . '&amount=' . $payAmount);
        exit();
    } else {
        header('location: ../html/cancelled.php');
        exit();
    }
}
