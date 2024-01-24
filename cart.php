<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./css/cart.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="icon" href="./assets/images/SN.png" type="image/png">
    <!-- TrustBox script -->
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
    <!-- End TrustBox script -->
</head>

<body>
    <div class="wrapper">
        <?php include_once('./components/header.php'); ?>

        <section id="cart" class="section-p1">
            <div class="left-section">
                <div class="path-top">
                    <div class="page-title">
                        <h2>Shopping Cart</h2>
                    </div>
                    <div class="page-path">
                        <a href="index.php">Main Page</a>
                        <div class="path"></div><a href="./sale.php">Shop</a>
                        <div class="path"></div><a href="#">Shopping Cart</a>
                    </div>
                </div>
                <div class="contents-bottom">
                    <div class="cart-title">
                        <div class="product">Product</div>
                        <div class="price">Price</div>
                        <div class="qty">Quantity</div>
                        <div class="total">Total</div>
                    </div>
                    <div class="cart-contents">
                    </div>
                    <div class="wishlist-btn">
                        <a href="wishlist.php">
                            <div class="btn-wishlist-page">Go To Wishlist <iconify-icon icon="bi:heart-fill" width="16"></iconify-icon>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="right-section">
                <div class="order-details">
                    <div class="top-section">
                        <div class="order-title">
                            <h3>Cart Summary</h3>
                        </div>
                        <div class="order-items">
                        </div>
                    </div>
                    <div class="bottom-section">
                        <div class="final-cta">
                            <div class="total-amount">
                                <h2>Total :</h2>
                                <span style='color: green;' id="cart-total-amount">Ksh. 0.00</span>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['userid'])) {
                            echo "<a class='btn-checkout proceed-check' href='checkout.php'>Proceed to Checkout</a>";
                        } else {
                            echo "<a class='btn-checkout proceed-check' href='signin.php'>Login to Checkout</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <?php 
        include_once './components/footer.php';
        ?>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="./js/app.js"></script>
    <script src="./js/cart.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
</body>

</html>