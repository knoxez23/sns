<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./css/thankyou.css">
    <link rel="icon" href="./assets/images/SN.png" type="image/png">
</head>

<body>
    <div class="wrapper">

        <section id="thankyou-section">
            <div class="thankyou-bg" style="width: 100%; position:relative; max-width: 1440px; height:160vh; display: flex;">
                <div class="left-section" style="background: linear-gradient(to bottom, rgba(255,255,255,0.2), rgba(0,0,0,0.2)); width: 50%;"></div>
                <div class="right-section" style="background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(255,255,255,0.2)); width: 50%;"></div>
                <div class="thankyou-div" style="position: absolute; width: 85%; top: 0; left: 50%; transform: translateX(-50%); background: #F6F4FB; border-radius: 15px; display: flex; flex-direction: column; gap: 30px; padding: 30px 0 90px 0;">
                    <div class="top-transaction-details">
                        <div class="top-thankyou-title">THANK YOU FOR YOUR PURCHASE</div>
                        <div class="transaction-dets-content">
                            <div class="left">
                                <div class="trans-div">
                                    <h3>Transaction Id: </h3>
                                </div>
                                <div class="trans-div">
                                    <h3>Name: </h3>
                                </div>
                                <div class="trans-div">
                                    <h3>Email: </h3>
                                </div>
                                <div class="trans-div">
                                    <h3>Contact: </h3>
                                </div>
                                <div class="trans-div">
                                    <h3>Address: </h3>
                                </div>
                            </div>
                            <div class="right">
                                <div class="trans-conten">
                                    <h4 id="transaction-id-cont"></h4>
                                </div>
                                <div class="trans-conten">
                                    <h4 id="card-holder"></h4>
                                </div>
                                <div class="trans-conten">
                                    <h4 id="user-email-dets"></h4>
                                </div>
                                <div class="trans-conten">
                                    <h4 id="user-contact-dets"></h4>
                                </div>
                                <div class="trans-conten">
                                    <h4 id="user-delivery-address"></h4>
                                </div>
                            </div>
                        </div>
                        <div class="email-notification">CHECK YOUR EMAIL FOR DETAILS ON THE DELIVERY</div>
                    </div>
                    <div class="bottom-products-details" style="padding: 0 40px; width: 100%; display:flex; align-items: center; flex-direction:column;">
                        <div class="products-title">PURCHASES MADE</div>
                        <div class="all-products" style="width: 100%;">
                            <div class="top-section">
                                <div class="product-div-title" style="font-family: Thiccboimedium;">
                                    <div class="pro-name">Name</div>
                                    <div class="pro-quantity">Quantity</div>
                                    <div class="pro-amount">Amount</div>
                                </div>
                            </div>
                            <div class="bottom-section" id="all-products-bought"></div>
                        </div>
                        <div class="total-amount-paid">
                            <div class="title-total-amnt">Amount + Shipping: </div>
                            <div class="actual-total-amnt" id="customer-paid-amount">$0.00</div>
                        </div>
                    </div>
                    <div class="homepage-btn" onclick="goHome()">Back to Home</div>
                </div>
            </div>
        </section>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="./js/thankyou.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
</body>

</html>