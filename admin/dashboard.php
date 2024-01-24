<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/dashboard.css">
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

            <section id="dashboard-section">
                <div class="top-analytics-earnings">
                    <div class="section-title">30 Days Performance</div>
                    <div class="bottom-details">
                        <div class="left-money-part top-btm-details">
                            <div class="total-earnings analytics-dtls">
                                <div class="total-earnings-logo dash-logo-div">
                                    <iconify-icon icon="ph:chart-line-up-bold" width="30"></iconify-icon>
                                </div>
                                <div class="total-earnings-details analy-title">
                                    <h5>Monthly earnings</h5>
                                    <h3 id='amount-earned-from-bsness'>Ksh0</h3>
                                </div>
                            </div>
                            <div class="goal-earnings analytics-dtls">
                                <div class="goal-earnings-logo dash-logo-div">
                                    <iconify-icon icon="fluent:target-arrow-24-regular" width="30"></iconify-icon>
                                </div>
                                <div class="goal-earnings-details analy-title">
                                    <h5>Goal for this month</h5>
                                    <h3 id='income-goal-amount-div'>Ksh0</h3>
                                </div>
                            </div>
                        </div>
                        <div class="center-customers-part top-btm-details">
                            <div class="customer-views analytics-dtls">
                                <div class="customer-views-logo dash-logo-div">
                                    <iconify-icon icon="fa-regular:eye" width="30"></iconify-icon>
                                </div>
                                <div class="customer-views-details analy-title">
                                    <h5>Views this month</h5>
                                    <h3 id='total-site-visits'>0</h3>
                                </div>
                            </div>
                            <div class="customer-followers analytics-dtls">
                                <div class="customer-followers-logo dash-logo-div">
                                    <iconify-icon icon="gridicons:reader-following" width="30"></iconify-icon>
                                </div>
                                <div class="customer-followers-details analy-title">
                                    <h5>Follows(Newsletter)</h5>
                                    <h3 id='number-of-follows'>0</h3>
                                </div>
                            </div>
                        </div>
                        <div class="right-spendings-part top-btm-details">
                            <div class="total-spending analytics-dtls">
                                <div class="total-spending-logo dash-logo-div">
                                    <iconify-icon icon="bx:line-chart-down" width="30"></iconify-icon>
                                </div>
                                <div class="total-spending-details analy-title">
                                    <h5>Monthly Spendings</h5>
                                    <h3 id='amount-spent-total'>Ksh0</h3>
                                </div>
                            </div>
                            <div class="spending-goal analytics-dtls">
                                <div class="spending-goal-logo dash-logo-div">
                                    <iconify-icon icon="fluent:target-arrow-20-filled" width="30"></iconify-icon>
                                </div>
                                <div class="spending-goal-details analy-title">
                                    <h5>Spending-goal</h5>
                                    <h3 id='expense-goal-amount-div'>Ksh0</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="center-analytics-views-chart">
                    <div class="chart">
                        <div class="chart-title">Analytics</div>
                        <div class="chart-div">
                             <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="shop-details">
                        <div class="new-clients cntr-rig-dtls">
                            <div class="new-clients-title">New Clients</div>
                            <div class="new-clients-details">
                                <h2 id='number-of-new-customers'>0</h2>
                            </div>
                        </div>
                        <div class="total-items cntr-rig-dtls">
                            <div class="total-items-title">Total Products Sold</div>
                            <div class="total-items-details">
                                <h2 id='number-of-pros-sold'>0</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-target-achieved-percent">
                    <div class="latest-customers">
                        <div class="latest-customers-title">
                            <h3>Latest Customers (<span id='newsletters-number'>0</span>)</h3>
                        </div>
                        <div class="latest-customers-content ltst-cont"></div>
                    </div>
                    <div class="latest-transactions">
                        <div class="latest-transactions-title">
                            <h3>Latest Transactions (<span id='transactions-number'>0</span>)</h3>
                        </div>
                        <div class="latest-transactions-content ltst-cont"></div>
                    </div>
                </div>
                <div class='add-goals'>
                    <div class="section-title">Add goals</div>
                    <form class='bottom-dets' action='./php/addgoals.php' method='POST'>
                        <div class="income">
                            <label for="income">Income</label>
                            <input type="number" name='income' placeholder="Income goal">
                        </div>
                        <div class="income">
                            <label for="expense">Expenditure</label>
                            <input type="number" name='expenses' placeholder="Maximum expense goal">
                        </div>
                        <button type='submit' class='submit-btn'>Add Goals</button>
                    </form>
                </div>
            </section>

        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <script src="./js/app.js"></script>
    <script src="./js/dashboard.js"></script>
</body>

</html>