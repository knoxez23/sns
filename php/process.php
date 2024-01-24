<?php

header('Access-Control-Allow-Origin: *');

if (!empty($_GET['paymentID']) && !empty($_GET['productId']) && !empty($_GET['qurikaka']) && !empty($_GET['utigaka']) && !empty($_GET['prodSize'])) {

    require_once 'db.php';
    include_once 'paypal.class.php';

    $paypal = new PaypalExpress;
    $totals = 0;

    // Get payment info from URL 
    $paymentID = $_GET['paymentID'];
    $productId = $_GET['priviaka'];
    $productQty = $_GET['qurikaka'];
    $userCheckid = $_GET['utigaka'];
    $productSize = $_GET['prodSize'];

    // Validate transaction via PayPal API 
    $paymentCheck = $paypal->validate($paymentID);

    // If the payment is valid and approved 
    if ($paymentCheck && $paymentCheck->state == 'approved' && $totals >= $paidAmount) {

        // Get the transaction data 
        $id = $paymentCheck->id;
        $state = $paymentCheck->state;
        $payerFirstName = $paymentCheck->payer->payer_info->first_name;
        $payerLastName = $paymentCheck->payer->payer_info->last_name;
        $payerName = $payerFirstName . ' ' . $payerLastName;
        $paidAmount = $paymentCheck->transactions[0]->amount->details->subtotal;
        $currency = $paymentCheck->transactions[0]->amount->currency;

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

        if (is_array($productId)) {
            for ($i = 0; $i < count($productId); $i++) {
                $orderStmnt = "INSERT INTO orders(customer_id, product_id, quantity, size, shipping_fee, total_paid) VALUES(?, ?, ?, ?, ?, ?)";
                $prep_orderStmnt = $conn->prepare($orderStmnt);
                $prep_orderStmnt->bind_param('issidd', $userCheckId, $productId[$i], $productQty[$i], $productSize[$i], $shipping_fee, $totals);
                $prep_orderStmnt->execute();
                $prep_orderStmnt->close();

                $txnStmnt = "INSERT INTO transactions(customer_id, customer_name, product_id, quantity, paid_amount, paid_amount_currency, txn_id, payment_status) VALUES(?, ?, ?, ?, ?, ?)";
                $prep_txnStmnt = $conn->prepare($txnStmnt);
                $prep_txnStmnt->bind_param('isiidsss', $userCheckId, $payerName, $productId, $productQty, $paidAmount, $currency, $id, $state);
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
            $prep_txnStmnt->bind_param('isiidsss', $userCheckId, $payerName, $productId, $productQty, $paidAmount, $currency, $id, $state);
            $prep_txnStmnt->execute();
            $prep_txnStmnt->close();
        }



        header('location: ../thankyou.php?txnid=' . $id . '&check=' . $userCheckId . '&cardholder=' . $payerName . '&amount=' . $paidAmount);
        exit();
    } else {
        header("Location: ../cancelled.php");
        exit();
    }
} else {
    // Redirect to the home page 
    header("Location: ..l/checkout.php");
    exit();
}
