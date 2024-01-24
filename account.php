<?php
session_start();
?>

<?php
if (!isset($_SESSION['userid'])) {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Account</title>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css' integrity='sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==' crossorigin='anonymous' referrerpolicy='no-referrer' rel='stylesheet' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css' />
    <link rel="stylesheet" href='./css/account.css'>
    <link rel="stylesheet" href='./css/reset.css'>
    <link rel="icon" href="./assets/images/SN.png" type="image/png">
    <!-- TrustBox script -->
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
    <!-- End TrustBox script -->
</head>

<body>
    <div class="wrapper">
        <?php include_once('./components/header.php'); ?>

        <?php include_once('./components/cart.php') ?>

        <section id="account" class="section-p1">
            <div class="top-title">
                <div class="title">
                    <h2>Account</h2>
                </div>
                <div class="user">
                    <iconify-icon icon="iconoir:profile-circled" width="60"></iconify-icon>
                    <div class="user-name">
                        <h4>
                            <?php
                            if (isset($_SESSION['userid'])) {
                                echo $_SESSION['username'] . ' ' . $_SESSION['userlast'];
                            }
                            ?>
                        </h4>
                        <h6><?php
                            if (isset($_SESSION['userid'])) {
                                echo "Member since " . $_SESSION['userdate'];
                            }
                            ?></h6>
                    </div>
                </div>
            </div>
            <div class="bottom-contents">
                <div class="left-section">
                    <div class="account-details" id="account-details-account-page">
                        <i></i>
                        <h4>Account Details</h4>
                    </div>
                    <div class="orders" id="order-details-account-page">
                        <i></i>
                        <h4>Orders</h4>
                    </div>
                </div>
                <div class="right-section">
                    <div class="account-right" id="account-details-section">
                        <div class="success-update-message-account">Update Successful</div>
                        <div class="title">
                            <h3>Account Details</h3>
                        </div>
                        <div class="contents">
                            <form action="" id="userDetails"></form>
                            <div class="veri-details">
                                <div class="email user">
                                    <label for="email">Email</label>
                                    <input id="someuid" type="hidden" value="<?php echo $_SESSION['userid']; ?>">
                                    <div class="user-dets email-input">
                                        <?php
                                        if (isset($_SESSION['userid'])) {
                                            echo $_SESSION['useremail'];
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="phone user">
                                    <label for="phone">Phone</label>
                                    <div class="user-dets" id="user-phone-no" contenteditable="true" onblur="updateValues(this, 'phone_number', <?php echo $_SESSION['userid']; ?>)" onclick="activate(this)">
                                    </div>
                                </div>
                                <div class="dob user">
                                    <label for="dob">Date of Birth <span style="font-size: 13px; font-family: 'Adobemedium';">e.g: 2022-10-24</span></label>
                                    <div class="user-dets" id="user-dob" contenteditable="true" onblur="updateValues(this, 'dob', <?php echo $_SESSION['userid']; ?>)" onclick="activate(this)">
                                    </div>
                                </div>
                            </div>

                            <div class=" location">
                                <div class=" state user">
                                    <label for="state">County</label>
                                    <div class="user-dets" id="user-state" contenteditable="true" onblur="updateValues(this, 'state', <?php echo $_SESSION['userid']; ?>)" onclick="activate(this)">
                                    </div>
                                </div>
                                <div class=" city user">
                                    <label for="City">City</label>
                                    <div class="user-dets" id="user-city" contenteditable="true" onblur="updateValues(this, 'city', <?php echo $_SESSION['userid']; ?>)" onclick="activate(this)">
                                    </div>
                                </div>
                                <div class=" address user">
                                    <label for="homeAddress">Address</label>
                                    <div class="user-dets" id="user-address" contenteditable="true" onblur="updateValues(this, 'home_address', <?php echo $_SESSION['userid']; ?>)" onclick="activate(this)">
                                    </div>
                                </div>

                            </div>

                            <div class=" save">
                                <form action="../php/logout.inc.php" method="POST">
                                    <button class="logout-btn">Log Out</button>
                                </form>
                            </div>
                            <div class="delete-acc">
                                <h3>Delete Account</h3>
                                <div class="btn-delete">Delete</div>
                            </div>
                        </div>
                    </div>
                    <div class="orders-right" id="order-details-section">
                        <div class="title">
                            <h3>Orders</h3>
                        </div>
                        <div class="order-contents">
                            <div class="order-titles">
                                <div class="pro-title">
                                    <h3>Product</h3>
                                </div>
                                <div class="order-status">
                                    <h3>Status</h3>
                                </div>
                                <div class="date-delivered">
                                    <h3>Delivery Date</h3>
                                </div>
                            </div>
                            <div class="all-orders" id="all-orders-made"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include_once('./components/footer.php') ?>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <script src="./js/app.js"></script>
    <script src="./js/account.js"></script>
    <script src="./js/minicart.js"></script>
</body>

</html>