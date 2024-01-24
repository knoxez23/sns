<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link rel="stylesheet" href="./css/wishlist.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="icon" href="./assets/images/SN.png" type="image/png">
    <!-- TrustBox script -->
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
    <!-- End TrustBox script -->
</head>

<body>
    <div class="wrapper">
        <?php include_once('./components/header.php'); ?>

        <?php include_once('./components/cart.php') ?>

        <section id="wishlist" class="section-p1">
            <div class="left-section">
                <div class="path-top">
                    <div class="page-title">
                        <h2>Wishlist</h2>
                    </div>
                    <div class="page-path">
                        <a href="index.php">Main Page</a>
                        <div class="path"></div>
                        <a href="./sale.php">Shop</a>
                        <div class="path"></div>
                        <a href="#">Wishlist</a>
                    </div>
                </div>
                <div class="contents-bottom">
                    <div class="cart-title">
                        <div class="product">Product</div>
                        <div class="price">Price</div>
                        <div class="qty">Stock Status</div>
                    </div>
                    <div class="wishlist-contents">
                    </div>
                    <div class="wishlist-btn">
                        <a href="cart.php">
                            <div class="btn-wishlist-page">Go To Cart <iconify-icon icon="lucide:shopping-cart"></iconify-icon></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="right-section">
                <div class="order-details">
                    <div class="top-section">
                        <div class="order-title">
                            <h3>Wishlist</h3>
                        </div>
                        <div class="wishlist-order-items">
                        </div>
                    </div>
                    <div class="bottom-section">
                        <div class="final-cta">
                            <div class="total-amount">
                                <h2>Total</h2>
                                <span style='color: green;' id="wishlist-items-amount">Ksh. 0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php 
        include_once './components/footer.php';
        ?>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <script src="./js/app.js"></script>
    <script src="./js/wishlist.js"></script>
    <script src="./js/minicart.js"></script>
</body>

</html>