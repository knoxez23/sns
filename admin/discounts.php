<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/discounts.css">
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

            <section id="discounts-section">
                <div class="add-discount-offer">
                    <div class="add-discount-title">Add A Discount</div>
                    <form class="add-discount-contents" action='./php/couponadd.php' method='POST'>
                        <div class="top-section">
                            <div class="coupon-name">
                                <label for="couponName">Coupon name</label>
                                <input type="text" name='coupname' placeholder="Registered Users">
                            </div>
                            <div class="coupon-code">
                                <label for="coupon">Coupon code:</label>
                                <input type="text" name='coupcode' placeholder="XXXXXX">
                            </div>
                            <div class="amount-discounted">
                                <label for="amount">Amount Discounted:</label>
                                <input type="text" name='coupamount' placeholder="45.89">
                            </div>
                        </div>
                        <div class="bottom-section">
                            <div class="criteria-title">Coupon Eligibility</div>
                            <div class="criteria-contents">
                                <div class="collective-users">
                                    <select name="user-criteria" id="coll-coup-criteria">
                                        <option value="1">All Newsletter Subscribers</option>
                                        <option value="2">All Registered Users</option>
                                        <option value="3">All Customers</option>
                                        <option value="4">First 100 Newsletter Subscribers</option>
                                        <option value="5">First 100 Registered Users</option>
                                        <option value="6">First 100 Customers</option>
                                    </select>
                                    <button type="submit" class="coupon-btn" id="coll-coupon-btn">Add Coupon</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="active-discount-offers">
                    <div class="active-discount-title">Active Discounts</div>
                    <div class="active-discount-contents">
                        <div class="active-contents-title">
                            <div class="acoupon-name-title">Name</div>
                            <div class="acoupon-amount-title">Amount</div>
                            <div class="acoupon-eligibility-title">Eligibility</div>
                            <div class="acoupon-status-title">Status</div>
                            <div class="acoupon-date-title">Date</div>
                        </div>
                        <div class="active-contents-contents" style='display:flex; flex-direction:column; gap: 20px;' id='discounts-cont'>
                            <!-- <div class="discount-div">
                                <div class="acoupon-name">Registered users</div>
                                <div class="acoupon-amount">$30.98</div>
                                <div class="acoupon-eligibility">All Registered Users</div>
                                <div class="acoupon-status">
                                    <button id="coupon-active-btn">Deactivate</button>
                                </div>
                                <div class="acoupon-date">22nd Dec 2021</div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="shipping-fees">
                    <div class="shipping-fees-title">Shipping Fees</div>
                    <div class="shipping-fees-content">
                        <div class="shipping-content-title">
                            <div class="scountry-title">Country</div>
                            <div class="scurrent-shipping-fees">Current Fee</div>
                            <div class="schange-value-shipping-fees">Change Fee</div>
                        </div>
                        <div class="shipping-content-contents">
                            <div class="country">
                                <select name="countries" id="countries">
                                </select>
                            </div>
                            <div class="current-shipping-fees">$50.97</div>
                            <div class="change-value-shipping-fees">
                                <input type="text" placeholder="72.33">
                            </div>
                            <button type="button" id="chnage-ship-fees-btn">Change</button>
                        </div>
                    </div>
                </div>
            </section>

        </main>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <script src="./js/discounts.js"></script>
    <script src="./js/app.js"></script>
</body>

</html>