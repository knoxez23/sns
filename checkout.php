<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="./css/checkout.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="icon" href="./assets/images/SN.png" type="image/png">
</head>

<body>

    <div class="wrapper">
        <?php include_once('./components/header.php'); ?>

        <section id="checkout" class="section-p1">
            <div class="left-section">
                <div class="top-part">
                    <div class="page-title">
                        <h2>Checkout</h2>
                    </div>
                    <div class="page-path">
                        <div><a href="index.php">Main Page</a></div>
                        <div class="path"></div>
                        <div><a href="catalog.php">Shop</a></div>
                        <div class="path"></div>
                        <div><a href="cart.php">Shopping Cart</a></div>
                        <div class="path"></div>
                        <div><a href="#">Checkout</a></div>
                    </div>
                </div>
                <div class="bottom-part">
                    <div class="user-details">
                        <div class="user-login">
                            <div class="left-portion">
                                <div class="profile-logo">
                                    <iconify-icon icon="et:profile-male" width="20"></iconify-icon>
                                </div>
                                <div class="login-info">
                                    <div class="login-title">
                                        <h3>LOGIN</h3>
                                        <iconify-icon icon="subway:tick" width="16"></iconify-icon>
                                    </div>
                                    <div class="login-details">
                                        <h2 id="user-name-dets"><span id="user-contact-dets"></span></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="right-portion">
                                <button class="btn-change" onclick="window.location.href='signin.php'">CHANGE</button>
                            </div>
                        </div>
                        <div class="delivery-address">
                            <div class="left-portion">
                                <div class="delivery-logo">
                                    <iconify-icon icon="carbon:delivery-parcel" width="20"></iconify-icon>
                                </div>
                                <div class="delivery-info">
                                    <div class="delivery-title">
                                        <h3>SHIPPING ADDRESS</h3>
                                        <div style="display: flex; align-items:center; justify-content:center;" id="shippadresstitleicon">
                                        </div>
                                    </div>
                                    <div class="address-details" id="user-address-dets">
                                        <h2></h2>
                                        <h2></h2>
                                        <h2></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="right-portion">
                                <button class="btn-change" onclick="window.location.href='account.php'">CHANGE</button>
                            </div>
                        </div>
                    </div>
                    <div class="payment-methods">
                        <div class="payment-title">
                            <div class="payment-logo">
                                <iconify-icon icon="dashicons:money-alt" style="color: white;" width="20"></iconify-icon>
                            </div>
                            <h3>PAYMENT METHOD</h3>
                        </div>
                        <div class="payment-content">
                            <div class="payment-method-column">
                                <div class="payment-column-title">
                                    <div class="payment-column-select"></div>
                                    <div class="payment-column-logo">
                                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M18 24h-12c-1.104 0-2-.896-2-2v-20c0-1.104.896-2 2-2h12c1.104 0 2 .896 2 2v20c0 1.104-.896 2-2 2zm1-5.083h-14v3.083c0 .552.449 1 1 1h12c.552 0 1-.448 1-1v-3.083zm-7 3c-.553 0-1-.448-1-1s.447-1 1-1c.552 0 .999.448.999 1s-.447 1-.999 1zm7-17h-14v13h14v-13zm-1-3.917h-12c-.551 0-1 .449-1 1v1.917h14v-1.917c0-.551-.448-1-1-1zm-4.5 1.917h-3c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h3c.276 0 .5.224.5.5s-.224.5-.5.5z"/></svg>
                                    </div>
                                    <h3>Mpesa</h3>
                                </div>
                                <div class="payment-column-content-card">
                                    <div class="card-payment-form">
                                        <div>
                                            <div class="card-dets">
                                                <div class="card-number-title">
                                                    <h3>Mpesa Number</h3>
                                                    <h5>Enter the number you want to pay using</h5>
                                                </div>
                                                <div class="card-number-inputs">
                                                    <h5 class="valid-no-error">Please enter a valid number</h5>                                                   
                                                    <input type="number" id="mpesa_no" placeholder="e.g 254712345678">
                                                </div>
                                            </div>
                                            <input type="hidden" id="userCheckout" value="<?php echo $_SESSION['userid']; ?>">
                                            <button type="button" disabled id="checkout-submit-dets">Pay Now</button>
                                            <button type="button" id="confirm-paid">I Have Already Paid</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-section">
                <div class="order-details">
                    <div class="top-section">
                        <div class="order-title">
                            <h3>Your Order</h3>
                        </div>
                        <div class="checkout-order-items">
                        </div>
                    </div>
                    <div class="bottom-section">                        
                        <div class="final-cta">                        
                            <div class="total-amount">
                                <h2>Product Total :</h2>
                                <span style="color: green;" id="checkout-total-amount">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                if(isset($_GET['msg'])){
                    $msg = $_GET['msg'];
                    if($msg == 'paid'){
                        echo '<div id="transaction" style="background-color: #fff; max-width: 600px; margin: 0 auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                <button type="button" style="align-self: end;" id="transaction-close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-x"></i></button>
                                <h2 style="color: #4CAF50; font-size: 40px;">Payment Successful!</h2>
                                <p>Your payment has been successfully processed. Thank you for your purchase.</p>
                                <p>Please check your <a href="account.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">account page</a> for details about your order.</p>
                                <p style="color: #777;">If you have any questions or concerns, feel free to <a href="contact.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">contact us</a>.</p>
                            </div>';
                    }else if($msg == 'invalidAmount'){
                        echo '<div id="transaction" style="background-color: #fff; max-width: 600px; margin: 0 auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                <button type="button" style="align-self: end;" id="transaction-close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-x"></i></button>
                                <h2 style="color: #FF5733; font-size: 40px;">Invalid Payment Amount</h2>
                                <p>It seems there was an issue with your payment amount. Please double-check the entered amount and try again.</p>
                                <p>If the problem persists or if you have any questions, feel free to <a href="contact.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">contact our support team</a>.</p>
                                <p style="color: #777;">We apologize for any inconvenience this may have caused.</p>
                            </div>';
                    }else if($msg == 'insufficientBalance'){
                        echo '<div id="transaction" style="background-color: #fff; max-width: 600px; margin: 0 auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                <button type="button" style="align-self: end;" id="transaction-close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-x"></i></button>
                                <h2 style="color: #FF5733; font-size: 40px;">Insufficient Balance</h2>
                                <p>We are sorry, but your payment cannot be processed due to insufficient funds in your account.</p>
                                <p>Please make sure your account has sufficient balance and try the payment again.</p>
                                <p>If you have any questions or concerns, please <a href="contact.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">contact our support team</a>.</p>
                                <p style="color: #777;">Thank you for your understanding.</p>
                            </div>';
                    } else if($msg == 'timeout'){
                        echo '<div id="transaction" style="background-color: #fff; max-width: 600px; margin: 0 auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                <button type="button" style="align-self: end;" id="transaction-close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-x"></i></button>
                                <h2 style="color: #FF5733; font-size: 40px;">Transaction Timed Out</h2>
                                <p>Unfortunately, your transaction has timed out. This could be due to inactivity or an issue with the connection.</p>
                                <p>Please initiate the payment process again. If you continue to experience issues, feel free to <a href="contact.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">contact our support team</a> for assistance.</p>
                                <p style="color: #777;">We appreciate your understanding and apologize for any inconvenience caused.</p>
                            </div>';
                    } else if($msg == 'cancelled'){
                        echo '<div id="transaction" style="background-color: #fff; max-width: 600px; margin: 0 auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                <button type="button" style="align-self: end;" id="transaction-close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-x"></i></button>
                                <h2 style="color: #FF5733; font-size: 40px;">Transaction Canceled</h2>
                                <p>Your transaction has been canceled. If this was unintentional, you can try initiating the payment process again.</p>
                                <p>If you have any questions or need assistance, please feel free to <a href="contact.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">contact our support team</a>.</p>
                                <p style="color: #777;">We apologize for any inconvenience and appreciate your understanding.</p>
                            </div>';
                    } else if($msg == 'failed'){
                        echo '<div id="transaction" style="background-color: #fff; max-width: 600px; margin: 0 auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                <button type="button" style="align-self: end;" id="transaction-close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-x"></i></button>
                                <h2 style="color: #FF5733; font-size: 40px;">Transaction Failed</h2>
                                <p>We regret to inform you that your transaction has failed. This could be due to various reasons, including insufficient funds, technical issues, or other issues.</p>
                                <p>It is crucial to address this matter promptly. Please <a href="contact.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">contact our support team immediately</a> for assistance in resolving the issue.</p>
                                <p style="color: #777;">We apologize for any inconvenience caused and appreciate your prompt attention to this matter.</p>
                            </div>';
                    } else if($msg == 'invalidTransaction'){
                        echo '<div id="transaction" style="background-color: #fff; max-width: 600px; margin: 0 auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                <button type="button" style="align-self: end;" id="transaction-close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-x"></i></button>
                                <h2 style="color: #FF5733; font-size: 40px;">Invalid Transaction</h2>
                                <p>We have detected that your transaction is invalid. This could be due to incorrect information, a security concern, or other issues.</p>
                                <p>For the security of your account, it is essential to address this matter urgently. Please <a href="contact.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">contact our support team immediately</a> to investigate and resolve the issue.</p>
                                <p style="color: #777;">We apologize for any inconvenience caused and appreciate your immediate attention to this matter.</p>
                            </div>';
                    }
                }
            ?>
            
        </section>

        
        <?php include_once './components/footer.php'; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="./js/app.js"></script>
    <script src="./js/checkout.js"></script>
</body>

</html>