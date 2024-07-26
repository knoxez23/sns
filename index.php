<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SN-SHOP Kenya | Sneakers for Men, Women, and Kids | Nike, Adidas, Puma</title>
    <meta name="description" content="Explore the latest collection of sneakers in Kenya at SN-SHOP. Enjoy up to 20% off on top brands like Nike. Nationwide shipping, fast delivery, and guaranteed quality. Shop now!">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" /> -->
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="icon" href="./assets/images/SN.png" type="image/png">
    <link rel="robots" href ="https://shoesnstrides.com/robots.txt">
    <link rel=”image_src” href=”https://shoesnstrides.com/assets/images/hero-pic.png" />
    <link rel="canonical" href="https://shoesnstrides.com"/>

    <!-- Structured Data Markup for AJ3 -->
    <script type="application/1d+json">
        {
            "@context": "https://schema.org",
            "@type": "Product",
            "name": "Air Jordan 3 Black Cement",
            "description": "The Air Jordan 3 Black Cement is a classic sneaker known for its iconic design, featuring a black leather upper, cement grey accents, and the famous elephant print. With its Air cushioning and Jumpman logo, it's a must-have for sneaker enthusiasts.",
            "image": "https://shoesnstrides.com/assets/images/J3-BLACK-CEMENT.jpg"
            "brand": {
                "@type": "Brand",
                "name": "Air Jordan"
            },
            "offers": {
                "@type": "Offer",
                "priceCurrency": "KSH",
                "price": "3800",
                "availability": "http://schema.org/InStock",
                "seller": {
                    "@type": "Organisation",
                    "name": "SN-STORE"
                }
            }
        }
    </script>

    

    <meta property="og:title" content="SN-SHOP | Your Source for Trendy Sneakers in Kenya">
    <meta property="og:description" content="Explore the latest collection of sneakers in Kenya at SN-STORE. Enjoy up to 20% off on top brands like Nike. Nationwide shipping, fast delivery, and guaranteed quality. Shop now!">
    <meta property="og:image" content="https://shoesnstrides.com/assets/images/hero-pic.png">
    <meta name="twitter:title" content="SN-SHOP | Your Source for Trendy Sneakers in Kenya">
    <meta name="twitter:description" content="Explore the latest collection of sneakers in Kenya at SN-STORE. Enjoy up to 20% off on top brands like Nike. Nationwide shipping, fast delivery, and guaranteed quality. Shop now!">
    <!-- TrustBox script -->
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
    <!-- End TrustBox script -->
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XTW21X4925"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-XTW21X4925');
</script>


<body>
    <div class="wrapper">
        <?php include_once('./components/header.php'); ?>

        <?php include_once('./components/cart.php') ?>

        <section id="hero" class="section-center section-p1">
            <div class="decorations">
                <span class="rectop"></span>
                <span class="reccenter"></span>
                <span class="recbottom"></span>
                <span class="recright"></span>
            </div>
            <div class="hero-content-right">
                <div class="right-showcase">
                    <div class="hero-showcase-shape"></div>
                    <h1 class='hero-text'>NIKE</h1>
                    <img class="hero-img" src="./assets/images/hero-pic.png" alt="Nike Sneakers on Sale at SN-STORE">
                </div>
            </div>
            <div class="hero-content-left">
                <h1>FIND YOUR STRIDE UPTO 20% OFF</h1>
                <h2>No matter what you need, find your sneaker from our various collections</h2>
                <a id="shop-all-btn" href = './mens.php' class="btn-shop">
                    Step into Style, Stride with Substance!
                </a>
                <div class="hero-cards"></div>
            </div>
        </section>

        <section id="aero" class="section-p1">
            <div class="aero-company-offers">
                <h2>What we <span>offer</span></h2>
                <div class="company-offers-cards">
                    <div class="aero-card">
                        <div class="card-image-bg">
                            <iconify-icon icon="emojione-monotone:airplane" width="50"></iconify-icon>
                        </div>
                        <h3>Country-wide Shipping</h3>
                        <p>Shop online, nationwide shipping for the best sneaker selection</p>
                        <iconify-icon icon="arcticons:nike" width="40"></iconify-icon>
                    </div>
                    <div class="aero-card">
                        <div class="card-image-bg">
                            <iconify-icon icon="iconoir:delivery-truck" width="50"></iconify-icon>
                        </div>
                        <h3>Fast Delivery</h3>
                        <p>Prompt delivery, exceeding all your service expectations.</p>
                        <iconify-icon icon="arcticons:nike" width="40"></iconify-icon>
                    </div>
                    <div class="aero-card">
                        <div class="card-image-bg">
                            <iconify-icon icon="icon-park-solid:folder-quality-one" width="50"></iconify-icon>
                        </div>
                        <h3>Guaranteed Quality</h3>
                        <p>Reliable products, backed by our unwavering quality assurance.</p>
                        <iconify-icon icon="arcticons:nike" width="40"></iconify-icon>
                    </div>
                    <div class="aero-card">
                        <div class="card-image-bg">
                            <iconify-icon icon="icon-park-outline:weixin-cards-offers" width="50"></iconify-icon>
                        </div>
                        <h3>Amazing Deals</h3>
                        <p>Unbeatable deals on top-notch products for incredible savings.</p>
                        <iconify-icon icon="arcticons:nike" width="40"></iconify-icon>
                    </div>
                </div>
            </div>
        </section>

        <?php 
        include_once('./components/topproducts.php')
        ?>

        <?php 
        include_once './components/footer.php';
        ?>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="./js/app.js"></script>
    <!-- <script src="./js/index.js"></script> -->
    <script src="./js/minicart.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
</body>

</html>