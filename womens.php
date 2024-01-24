<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women's</title>
    <meta name="description" content="Elevate your style with the latest women's sneakers at SN-SHOP. Browse a curated selection of fashionable and comfortable footwear for every occasion. From active lifestyle shoes to trendy streetwear, our women's collection has it all. Explore top brands like Nike, Adidas, and more. Shop now!">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link rel="stylesheet" href="./css/catalog.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="icon" href="./assets/images/SN.png" type="image/png">
    <link rel="canonical" href="https://www.snshop.co.ke"/>
    <script src="https://kit.fontawesome.com/2affe6feb2.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- TrustBox script -->
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
    <!-- End TrustBox script -->
</head>

<body>
    <div class="wrapper">
        <?php include_once('./components/header.php'); ?>

        <?php include_once('./components/cart.php'); ?>

        <?php include_once('./components/catalog.php'); ?>

        <div class="pagination">
        </div>

        <?php 
        include_once './components/topproducts.php';
        ?>

        <?php 
        include_once './components/footer.php';
        ?>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <script src="./js/app.js"></script>
    <script src="./js/filter.js"></script>
    <script src="./js/women.js"></script>
    <script src="./js/minicart.js"></script>
</body>

</html>