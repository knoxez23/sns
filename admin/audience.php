<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/audience.css">
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

            <section id="audience-section">
                <div class="audience">
                    <div class="customers">
                        <div class="customers-title">All Purchases (<span id='all-customers-number'>0</span>)</div>
                        <div class="customers-contents">
                            <div class="customer-contents-title">
                                <div class="cfname-title">Name</div>
                                <div class="cemail-title">Email</div>
                                <div class="cnumber-title">Contact</div>
                                <div class="cstatus-title">Status</div>
                                <div class="cproduct-title">Product</div>
                                <div class="cquantity-title">Quantity</div>
                                <div class="camount-title">Amount</div>
                                <div class="cdate-title">Date</div>
                            </div>
                            <div class="customer-contents-contents" style='display: flex; flex-direction: column; gap: 20px;'>
                                <!-- <div class="customer-div">
                                    <div class="cfname">Chris</div>
                                    <div class="cemail">chrisbumstead@gmail.com</div>
                                    <div class="cnumber">09787837878</div>
                                    <div class="cstatus active">Subscribed</div>
                                    <div class="cproduct">Airforce 1</div>
                                    <div class="cquantity">4</div>
                                    <div class="camount">$890.90</div>
                                    <div class="cdate">23rd Jul 2021</div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="users">
                        <div class="users-title">All Registered Users (<span id='all-users-number'>0</span>)</div>
                        <div class="users-contents">
                            <div class="users-contents-title">
                                <div class="ufname-title">Name</div>
                                <div class="uemail-title">Email</div>
                                <div class="ustatus-title">State</div>
                                <div class="unumber-title">Contact</div>
                                <div class="ucountry-title">Country</div>
                                <div class="udate-title">Date</div>
                            </div>
                            <div class="users-contents-contents"></div>
                        </div>
                    </div>
            </section>

        </main>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <script src="./js/audience.js"></script>
    <script src="./js/app.js"></script>
</body>

</html>