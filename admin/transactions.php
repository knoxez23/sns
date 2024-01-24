<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/transactions.css">
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

            <section id="transactions-section">
                <div class="transactions-analytics">
                    <div class="transactions-analytics-title">Transaction Analytics</div>
                    <div class="transactions-analytics-contents">
                        <div class="pie-charts-transactions">
                            <canvas id="myChart"></canvas>
                        </div>
                        <div class="total-revenue">
                            <div class="total-amount-made rev-div">
                                <div class="total-amount-made-title rev-title">Overall Amount Made:</div>
                                <div class="total-amount-made-contents rev-content">$0</div>
                            </div>
                            <div class="total-amount-investedback rev-div">
                                <div class="total-amount-invested-title rev-title">Amount used in business:</div>
                                <div class="total-amount-invested-contents rev-content">$0</div>
                            </div>
                            <div class="total-profit rev-div">
                                <div class="total-profit-title rev-title">Overall Profit/Loss:</div>
                                <div class="total-profit-contents rev-content">$0</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inbusiness-transactions">
                    <div class="top-section">
                        <form action='./php/inbusinessadd.php' method='POST' class="add-inbusiness-transaction">
                            <div class="add-inbusiness-title">Add In-business Transaction</div>
                            <div class="add-inbusiness-contents">
                                <div class="amount-used-input-title in-input">
                                    <label for="amountInbusiness">Amount:</label>
                                    <input type="text" name="amount" placeholder="Amount">
                                </div>
                                <div class="company-input-title in-input">
                                    <label for="companyInbusiness">Company:</label>
                                    <input type="text" name="company" placeholder="Company">
                                </div>
                                <div class="purpose-input-title in-input">
                                    <label for="purposeInbusiness">Purpose</label>
                                    <textarea name="purpose" id="" cols="30" rows="10" placeholder="Purpose of transaction"></textarea>
                                </div>
                            </div>
                            <button style='align-self: flex-end; padding: 10px 30px; border: 1px solid #000;' type="submit">Add</button>
                        </form>
                    </div>
                    <div class="bottom-section">
                        <div class="inbusiness-title">In-business Transactions (<span id='inbusiness-trans-number'>0</span>)</div>
                        <div class="inbusiness-contents">
                            <div class="inbusiness-contents-title">
                                <div class="inamount-used-title">Amount</div>
                                <div class="incompany-title">Company</div>
                                <div class="inpurpose-title">Purpose</div>
                                <div class="indate-title">Date</div>
                            </div>
                            <div class="inbusiness-contents-contents">
                                <!-- <div class="inbusiness-div">
                                    <div class="inamount-used">$2000</div>
                                    <div class="incompany">Nike</div>
                                    <div class="inpurpose">
                                        Buying a new bundle of Airforce 1 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corrupti, ratione.
                                    </div>
                                    <div class="indate"> 23rd Aug 2022</div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="latest-transactions">
                    <div class="latest-transactions-top">
                        <div class="latest-transactions-title">Latest Transactions (<span id='latest-transactions-number'>0</span>)</div>
                        <div class="latest-transactions-search">
                            <input type="search" id='transaction-search-input' placeholder="Search Name">
                            <button type="button" id='search-transaction-btn'>Search</button>
                        </div>
                    </div>
                    <div class="latest-transactions-contents">
                        <div class="transactions-contents-title">
                            <div class="trname-title">Name</div>
                            <div class="tremail-title">Email</div>
                            <div class="trnumber-title">Contact</div>
                            <div class="trproduct-title">Product</div>
                            <div class="trquantity-title">Quantity</div>
                            <div class="tramount-title">Amount</div>
                            <div class="trstatus-title">Status</div>
                            <div class="trdate-title">Date</div>
                        </div>
                        <div class="transactions-contents-contents">
                            <!-- <div class="transaction-cdiv">
                                <div class="trname">James Wisnire</div>
                                <div class="tremail">jameswisnire@gmail.com</div>
                                <div class="trnumber">0989778632</div>
                                <div class="trproduct">Airforce 1</div>
                                <div class="trquantity">3</div>
                                <div class="tramount">$920.80</div>
                                <div class="trstatus active">Delivered</div>
                                <div class="trdate">24th Sep 2022</div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </section>

        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <script src="./js/transactions.js"></script>
    <script src="./js/app.js"></script>
</body>

</html>