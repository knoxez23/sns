<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/orders.css">
    <link rel="stylesheet" href="./css/sidebar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <title>Admin</title>
</head>

<body>

    <div class="wrapper">

        <main id="visible-page-section">

            <?php
                include_once 'sidebar.php';
            ?>

            <section id="orders-section">
                <div class="pending-orders">
                    <div class="pending-orders-title">Pending Orders (<span id='pending-orders-number'>0</span>)</div>
                    <div class="pending-orders-contents">
                        <div class="pending-contents-title">
                            <div class="orderId-title">Order Id</div>
                            <div class="fname-title">Name</div>
                            <div class="email-title">Email</div>
                            <div class="address-title">Address</div>
                            <div class="number-title">Contact</div>
                            <div class="product-title">Product</div>
                            <div class="quantity-title">Quantity</div>
                            <div class="status-title">Status</div>
                            <div class="date-title">Date</div>
                        </div>
                        <div class="pending-contents-contents">
                            <!-- <div class="pending-div">
                                <div class="orderId">#SN89OI</div>
                                <div class="fname">Jane</div>
                                <div class="email">janedoe@gmail.com</div>
                                <div class="address">38th Edmont Street</div>
                                <div class="number">0982876761</div>
                                <div class="product">Yeezy 350</div>
                                <div class="quantity">5</div>
                                <div class="status">
                                    <select name="status" id="orderStatus">
                                        <option value="pending">Pending</option>
                                        <option value="complete">Close</option>
                                    </select>
                                </div>
                                <div class="date">22nd Jun 2019</div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="closed-orders">
                    <div class="closed-orders-title">Closed Orders (<span id='closed-orders-number'>0</span>)</div>
                    <div class="closed-orders-contents">
                        <div class="closed-contents-title">
                            <div class="clorderId-title">Order Id</div>
                            <div class="clfname-title">Name</div>
                            <div class="clemail-title">Email</div>
                            <div class="clnumber-title">Contact</div>
                            <div class="claddress-title">Address</div>
                            <div class="clproduct-title">Product</div>
                            <div class="clquantity-title">Quantity</div>
                            <div class="clstatus-title">Status</div>
                            <div class="cldate-title">Date</div>
                        </div>
                        <div class="closed-contents-contents">
                            <!-- <div class="closed-div">
                                <div class="clorderId">#SN52OC</div>
                                <div class="clfname">Gabi</div>
                                <div class="clemail">gabireynolds@gmail.com</div>
                                <div class="clnumber">09377938381</div>
                                <div class="claddress">24th Sutah St. USA Virginia</div>
                                <div class="clproduct">Airforce 1</div>
                                <div class="clquantity">2</div>
                                <div class="clstatus active">Delivered</div>
                                <div class="cldate">23rd Jul 2020</div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </section>

        </main>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <script src='./js/orders.js'></script>
    <script src="./js/app.js"></script>
</body>

</html>